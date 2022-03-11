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
vendor/bin/sail artisan make:policy UserPolicy --model=User
```
