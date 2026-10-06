# Admin credential setup and deployment

Admin credentials are not stored in PHP source. `scripts/seed_admin.php` creates
an account only when the configured email does not already exist. It will not
reset an existing account. Passwords are stored with `password_hash()`; neither
the seeder nor the synchronization command prints passwords or hashes.

## Local setup

1. Copy `.env.example` to `.env` in the project root. The `.env` file is ignored
   by Git.
2. Set `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and `DB_PASS` to the local
   MySQL connection.
3. Set the optional admin values in `.env` by uncommenting them and replacing
   the example values. Quote password values containing spaces or `#`:

   ```dotenv
   ESUDHA_ADMIN_NAME=Live Admin
   ESUDHA_ADMIN_EMAIL=admin@example.com
   ESUDHA_ADMIN_PASSWORD="replace-with-a-unique-secret"
   ESUDHA_ADMIN_EXPECTED_EMAIL=current-id-1-email@example.com
   ```

   Do not put real credentials in `.env.example` or source control.
4. To create a first admin only, set `ESUDHA_ADMIN_NAME`,
   `ESUDHA_ADMIN_EMAIL`, and `ESUDHA_ADMIN_PASSWORD`, then run:

   ```powershell
   C:\xampp\php\php.exe scripts\seed_admin.php
   ```

   The seeder refuses to replace an existing account.
5. To intentionally synchronize an existing local admin at ID 1, also set
   `ESUDHA_ADMIN_EXPECTED_EMAIL` to the email currently stored on ID 1. First
   run the read-only check, then run the synchronizer:

   ```powershell
   C:\xampp\php\php.exe scripts\sync_admin_credentials.php --check
   C:\xampp\php\php.exe scripts\sync_admin_credentials.php
   ```

   The synchronizer updates only ID 1. It requires the current email to match
   `ESUDHA_ADMIN_EXPECTED_EMAIL`; if the account already has the desired name,
   email, and password, it succeeds without writing. To intentionally reset
   credentials later, update the expected email to the verified current ID 1
   email and run the command manually again.

## Plesk production deployment

1. Back up the production database. Confirm the account currently at admin ID 1
   using Plesk's database tools or a trusted SSH MySQL client. For example,
   inspect only its non-secret identity fields:

   ```sql
   SELECT id, name, email FROM admins WHERE id = 1;
   ```

   Verify the email with the account owner; do not assume the local email is
   its identity. Do not select or copy the password hash.
2. Deploy the application code, including `scripts/sync_admin_credentials.php`.
   Do not deploy the local `.env` file.
3. Provide production-specific `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, and
   `DB_PASS` through Plesk's protected PHP environment configuration. For CLI
   execution, the same variables must be available to that CLI process.
4. Store `ESUDHA_ADMIN_NAME`, `ESUDHA_ADMIN_EMAIL`, and
   `ESUDHA_ADMIN_PASSWORD` in protected production configuration. Set
   `ESUDHA_ADMIN_EXPECTED_EMAIL` to the verified current email of production
   admin ID 1. Never copy local database settings or assume production is
   named `esudha_db`.
5. Prefer a private environment file outside the document root, restricted to
   the website/PHP user (for example, owner read/write only). Set
   `ESUDHA_ENV_FILE` to its absolute path in the PHP runtime and CLI
   environment. The application supports this path; without it, it reads
   `.env` from the project root. If using a project-root `.env`, restrict file
   permissions and confirm it cannot be downloaded over HTTP. `.htaccess`
   protection only applies when Apache processes the request; also check any
   Nginx/static-file rules in the hosting setup.
6. Run these commands over SSH or Plesk's trusted CLI terminal from the
   deployed project directory. The `--check` command is read-only and prints
   the connected database name and MySQL server host fingerprint so you can
   confirm the target before changing anything. If multiple PHP versions are
   installed, use the CLI binary for the version configured for this domain
   (Plesk commonly installs binaries under `/opt/plesk/php/<version>/bin/php`):

   ```sh
   php scripts/sync_admin_credentials.php --check
   php scripts/sync_admin_credentials.php
   ```

   If PHP environment values are not inherited by CLI, set them in the
   protected CLI environment or use `ESUDHA_ENV_FILE` to point to the protected
   file. For manual terminal entry, use a no-echo prompt (for example,
   `read -r -s ESUDHA_ADMIN_PASSWORD; export ESUDHA_ADMIN_PASSWORD`) rather than
   typing the secret in a command. Never put a password in a command-line
   argument, shell history, URL, deployment log, or source control.
7. On success, remove/unset the desired admin password and expected-email
   values from the one-time CLI environment if no longer needed. Keep any
   application runtime variables in Plesk's protected configuration only if
   required by your operational process. The synchronizer is not connected to
   deployment hooks and must be invoked manually.
8. Test sign-in on the live HTTPS site. If it fails, check the production PHP
   error log and verify the production DB environment, ID 1 email, CSRF token,
   and session cookie behavior. Do not run the first-admin seeder on production
   to reset an existing account.

The synchronizer is CLI-only, uses prepared statements and a transaction,
checks for a duplicate target email, and refuses to update ID 1 unless its
current email matches the explicitly configured expected identity. It never
creates another account or exposes an HTTP reset endpoint.
