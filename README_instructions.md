# Run instructions (Windows-based):
- in terminal in vscode: `docker-compose up`
- click dropdown on the right side and click the option `New Command Prompt`
- in this new cmd, type `php artisan db:seed`
- if an login error occurs (postgres wrong password or something along that), Control + C each of the terminals and "Quit Docker Desktop". Open a terminal in Windows as administrator and type `taskkill /IM postgres.exe /F`. Do it again. If a message saying no process postgres found or similar, it worked. Go back to the beggining of these instructions and try again.
- in the same cmd as the db seed command, type `php artisan serve`
- control + click on the link and change the url to navigate to the respective page (for example, http://127.0.0.1:8000/auctions/1)