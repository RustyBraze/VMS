# **Guide: Enabling GPG Signing for Git Commits**

## **1. What is GPG Signing for Git?**
Git allows you to sign your commits and tags using **GPG (GNU Privacy Guard)**. This ensures:
- **Authenticity**: Verifies the commit was made by you.
- **Integrity**: Confirms the commit hasn't been altered.
- **Trust**: Organizations can enforce signed commits.

---

# **2. Installing GPG**
## **Windows (Using Gpg4Win & Kleopatra)**
1. **Download Gpg4Win (Kleopatra)** from:  
   👉 [https://www.gpg4win.org/download.html](https://www.gpg4win.org/download.html)
2. **Install** it with default settings.
3. **Open Kleopatra** and generate a new GPG key:
    - Click **“File” > “New Key Pair”**.
    - Choose **“Create a personal OpenPGP key pair”**.
    - Enter your **name** and **email** (must match your Git settings).
    - Click **"Advanced Settings"** → Select **RSA (4096-bit)**.
    - Click **Create** and **set a passphrase**.
    - Save your **GPG Key Fingerprint** (you'll need it later).
4. **Export the Public Key**:
    - In Kleopatra, select your key → **Right-click > Export**.
    - Upload this key to GitHub (see Step 5).

## **Linux (Ubuntu/Debian/Fedora/Arch)**
1. **Install GPG**:
   ```sh
   sudo apt install gnupg  # Debian/Ubuntu
   sudo dnf install gnupg  # Fedora
   sudo pacman -S gnupg    # Arch
   ```
2. **Generate a GPG Key**:
   ```sh
   gpg --full-generate-key
   ```
    - Select: **RSA and RSA (4096-bit)**
    - Set expiration date (or choose "0" for no expiration).
    - Enter your **name** and **email** (same as Git).
    - Set a **secure passphrase**.
3. **Get Your GPG Key Fingerprint**:
   ```sh
   gpg --list-secret-keys --keyid-format LONG
   ```
   Copy the key **after `sec rsa4096/`** (e.g., `ABC123DEF456`).

## **macOS**
1. **Install GPG (via Homebrew)**:
   ```sh
   brew install gnupg
   ```
2. **Generate a GPG Key**:
   ```sh
   gpg --full-generate-key
   ```
    - Select **RSA (4096-bit)**.
    - Enter **name** and **email** (same as Git).
    - Set a **passphrase**.
3. **Get Your GPG Key Fingerprint**:
   ```sh
   gpg --list-secret-keys --keyid-format LONG
   ```

---

# **3. Configuring Git to Sign Commits**
## **Windows (Gpg4Win)**
1. Open **Git Bash** or a terminal.
2. Set the GPG program path:
   ```sh
   git config --global gpg.program "C:/Program Files (x86)/GnuPG/bin/gpg.exe"
   ```
3. Set Git to **sign all commits** by default:
   ```sh
   git config --global commit.gpgsign true
   ```
4. Set your GPG key for Git:
   ```sh
   git config --global user.signingkey ABC123DEF456
   ```
   *(Replace `ABC123DEF456` with your actual key ID.)*

## **Linux/macOS**
1. Set Git to **sign commits automatically**:
   ```sh
   git config --global commit.gpgsign true
   ```
2. Set your **GPG key**:
   ```sh
   git config --global user.signingkey ABC123DEF456
   ```

---

# **4. Exporting & Uploading Your Public Key to GitHub**
After creating your GPG key, you need to upload your **public key** to GitHub.

## **Find & Export Your Public Key**
Run:
```sh
gpg --armor --export YOUR_KEY_ID
```
Example output:
```
-----BEGIN PGP PUBLIC KEY BLOCK-----
...
-----END PGP PUBLIC KEY BLOCK-----
```
1. Copy everything, including `-----BEGIN` and `-----END-----`.
2. Go to:
    - **GitHub**: [https://github.com/settings/gpg-keys](https://github.com/settings/gpg-keys)
3. **Paste the key** and save it.

---

# **5. Testing Your GPG Signed Commit**
To test if your Git commits are now signed:

```sh
git commit -S -m "My first signed commit"
```
(Use `-S` to manually sign a commit.)

To verify if the commit was signed:
```sh
git log --show-signature -1
```
If successful, you should see:
```
gpg: Signature made ...
gpg: Good signature from "Your Name <your-email@example.com>"
```

---

# **6. Troubleshooting**
### **❌ ERROR: "gpg failed to sign the data"**
#### **Fix for Windows (Gpg4Win)**
Run:
```sh
echo "test" | gpg --clearsign
```
If prompted for a passphrase but it fails:
- Open **Kleopatra** → Right-click your key → **Change Expiry Date** (extend it).
- Restart your computer.
- Run:
  ```sh
  echo "test" | gpg --clearsign
  ```
  Again to ensure it works.

#### **Fix for Linux/macOS**
If Git can't find `gpg`, tell it where to look:
```sh
git config --global gpg.program $(which gpg)
```
If you get:
```
gpg: signing failed: Inappropriate ioctl for device
```
Try:
```sh
export GPG_TTY=$(tty)
echo "export GPG_TTY=$(tty)" >> ~/.bashrc
source ~/.bashrc
```

---

# **7. Summary**
| OS       | GPG Installation | Git Config Path | Special Instructions |
|----------|-----------------|-----------------|----------------------|
| **Windows** | Gpg4Win (Kleopatra) | `C:/Program Files (x86)/GnuPG/bin/gpg.exe` | Set GPG path in Git |
| **Linux** | `gnupg` package | `which gpg` | Export `GPG_TTY` |
| **macOS** | `brew install gnupg` | `which gpg` | Export `GPG_TTY` |
