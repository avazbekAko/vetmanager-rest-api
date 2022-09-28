<p>1. Run <code>composer install</code></p>
<p>2. Rename <code>.env.example -> .env</code></p>
<p>3. Run <code>./vendor/bin/sail up -d</code></p>
<p>4. Run <code>docker exec -it vetmanager-rest-api_laravel.test_1 bash</code></p>
<p>5. Run <code>php artisan migrate</code></p>
<p>6. Run <code>php artisan db:seed --class=UserSeeder</code></p>
<p>7. Run <code>npm install</code></p>
<p>8. Run <code>npm run dev</code></p>
