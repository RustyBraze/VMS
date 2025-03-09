<?php

namespace App\Controller;

use App\Entity\SystemConfiguration;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Attribute\Route;

//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Handles the installation process of the application.
 *
 * The install method orchestrates different installation steps based on the
 * provided step parameter. These steps involve database setup, admin account
 * creation, configuration updates, and saving the final configuration.
 */
class InstallController extends AbstractController
{
    #[Route('/install/{step}', name: 'app_install', defaults: ["step" => 1])]
    public function install(int $step, Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $rootPath = $this->getParameter('kernel.project_dir');
        $filesystem = new Filesystem();

        if (!$filesystem->exists($rootPath . '/installed')) {
            return $this->redirectToRoute('app_home');
        }

        switch ($step) {
            case 0:
                // Page items that need to be loaded/set
                $page_content = [
                    'title' => 'Welcome',
                    'progress' => 0,
                    'progress_min' => 0,
                    'progress_max' => 5,
                ];
                return $this->render(view: 'pages/install/welcome.html.twig',
                    parameters: $page_content
                );

            case 1:
                return $this->handleDatabaseSetup($request, $rootPath);
            case 2:
                return $this->handleAdminCreation($request, $entityManager, $passwordHasher);
            case 3:
                return $this->handleBaseConfiguration($request);
            case 4:
                return $this->saveConfiguration($entityManager);
            case 5:
                $filesystem->remove($rootPath . '/installed');
                return $this->redirectToRoute('app_home');
        }

        return $this->redirectToRoute('app_install', ['step' => 1]);
    }

    private function handleDatabaseSetup(Request $request, string $rootPath): Response
    {
        $errorMessage = null;

        if ($request->isMethod('POST')) {
            $dbType = $request->request->get('db_type');
            $dbHost = $request->request->get('db_host');
            $dbPort = $request->request->get('db_port');
            $dbName = $request->request->get('db_name');
            $dbUser = $request->request->get('db_user');
            $dbPass = $request->request->get('db_pass');

            $dsn = "$dbType:host=$dbHost;port=$dbPort;dbname=$dbName";

            try {
                new \PDO($dsn, $dbUser, $dbPass);

                $configContent = <<<EOL
DATABASE_URL="{$dbType}://{$dbUser}:{$dbPass}@{$dbHost}:{$dbPort}/{$dbName}"
EOL;

                file_put_contents($rootPath . '/.env.local', $configContent);

                return $this->redirectToRoute('app_install', ['step' => 2]);

            } catch (\Exception $e) {
                $errorMessage = "Database connection failed: " . $e->getMessage();
            }
        }
        // Page items that need to be loaded/set
        $page_content = [
            'title' => 'Database Setup',
            'progress' => 1,
            'progress_min' => 1,
            'progress_max' => 5,
            'error' => $errorMessage
        ];
        return $this->render(view: 'pages/install/database.html.twig',
            parameters: $page_content
        );
    }

    private function handleAdminCreation(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        if ($request->isMethod('POST')) {
            // TODO: FIX THIS SHIT
//            $username = $request->request->get('username');
//            $password = $passwordHasher->hashPassword($username, $request->request->get('password'));
//
//            $admin = new User();
//            $admin->setUsername($username);
//            $admin->setRoles(['ROLE_ADMIN']);
//            $admin->setPassword($password);
//
//            $entityManager->persist($admin);
//            $entityManager->flush();

            return $this->redirectToRoute('app_install', ['step' => 3]);
        }

        // Page items that need to be loaded/set
        $page_content = [
            'title' => 'Account Setup',
            'progress_min' => 1,
            'progress_max' => 5,
            'progress' => 3
        ];
        return $this->render(view: 'pages/install/admin.html.twig',
            parameters: $page_content
        );
    }

    private function handleBaseConfiguration(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $config = [
                'project_name' => $request->request->get('project_name', 'Volunteer Management System'),
                'short_name' => $request->request->get('short_name', 'VMS'),
                'volunteer_label' => $request->request->get('volunteer_label', 'Volunteer'),
                'staff_label' => $request->request->get('staff_label', 'Staff'),
                'department_head_label' => $request->request->get('department_head_label', 'Department Head'),
                'shift_manager_label' => $request->request->get('shift_manager_label', 'Shift Manager'),
                'logo' => $request->files->get('logo') ?: 'assets/images/default_logo.png',
                'favicon' => $request->files->get('favicon') ?: 'assets/images/default_fav.png',
            ];

            file_put_contents($this->getParameter('kernel.project_dir') . '/config/global_config.json', json_encode($config));

            return $this->redirectToRoute('app_install', ['step' => 4]);
        }

        // Page items that need to be loaded/set
        $page_content = [
            'title' => 'Configuration',
            'progress_min' => 1,
            'progress_max' => 5,
            'progress' => 4
        ];
        return $this->render(view: 'pages/install/configuration.html.twig',
            parameters: $page_content
        );
    }

    private function saveConfiguration(EntityManagerInterface $entityManager): Response
    {
        $config = json_decode(file_get_contents($this->getParameter('kernel.project_dir') . '/config/global_config.json'), true);

        foreach ($config as $key => $value) {
            $setting = new SystemConfiguration();
            $setting->setKey($key);
            $setting->setValue($value);
            $entityManager->persist($setting);
        }

        $entityManager->flush();
        return $this->redirectToRoute('app_install', ['step' => 5]);
    }
}