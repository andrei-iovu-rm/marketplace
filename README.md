- Install tailwind & watcher
```
vendor/bin/sail npm install -D tailwindcss postCss
vendor/bin/sail npx tailwindcss init
vendor/bin/sail npm install -D browser-sync
vendor/bin/sail npm install -D daisyui
```

- Create symbolic linnk for uploaded images
```
vendor/bin/sail php artisan storage:link
```

- Start Tailwind
```
vendor/bin/sail npm run dev
npm run watch
```

- PhpStorm Helpers
```
vendor/bin/sail artisan ide-helper:generate
vendor/bin/sail artisan ide-helper:meta
```

- The most used artisan commands
```
vendor/bin/sail artisan make:model TableName -mfsc
vendor/bin/sail artisan migrate:fresh --seed
vendor/bin/sail php artisan make:livewire Folder/ComponentName
vendor/bin/sail php artisan make:test Folder/TestName
vendor/bin/sail test
vendor/bin/sail test --filter TestName
vendor/bin/sail artisan make:policy UserPolicy --model=User
```

- Install Nova
```
vendor/bin/sail composer config repositories.nova '{"type": "composer", "url": "https://nova.laravel.com"}' --file composer.json
vendor/bin/sail composer update --prefer-dist
vendor/bin/sail artisan vendor:publish --tag=laravel-assets --ansi --force
vendor/bin/sail php artisan nova:install
vendor/bin/sail php artisan migrate
```

- The most used Nova commands
```
vendor/bin/sail artisan nova:resource Category -m=Category
vendor/bin/sail artisan nova:filter UserRole
vendor/bin/sail artisan nova:lens TopAgents
vendor/bin/sail artisan nova:action ChangeUserRole
vendor/bin/sail artisan nova:value NewUsers
vendor/bin/sail artisan nova:trend UsersPerDay
```
