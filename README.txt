Github repository: https://github.com/vinothkbest/taskapp-ait
1)clone it
2) set up .env file
3) run 'composer install'
5) run 'npm install' via node
4) After npm & composer install, run 'php artisan migrate' and 'php artisan db:seed --class=AdminSeeder'
6) change 'baseURL' variable as your localhost url in the following vue files in dir: resources/js/
	i) /components/Tables/UserTable.vue at line 25
	ii) /pages/UserProfile/AddProfileForm.vue at line 64
	iii) /pages/UserProfile/EditProfileForm.vue at line 70
	iv) store/store.js at line 5
7) run 'npm run watch' or 'npm run dev' to update vue code
3) run 'php artisan serve' because front end run on this domain http://127.0.0.1:8000/#/
4) use link for admin http://127.0.0.1:8000/#/admin-login
5) use link for user http://127.0.0.1:8000/#/user-login