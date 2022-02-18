- Install tailwind & watcher
```
vendor/bin/sail npm install -D tailwindcss postCss
vendor/bin/sail npx tailwindcss init
vendor/bin/sail npm install -D browser-sync
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
```
