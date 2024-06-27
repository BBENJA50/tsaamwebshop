<!-- TABLE OF CONTENTS -->
<details>
  <summary>Inhoudstafel</summary>
  <ol>
    <li>
      <a href="#about-the-project">Over Dit Project</a>
      <ul>
        <li><a href="#built-with">Gemaakt Met</a></li>
      </ul>
    </li>
    <li>
      <ul>
        <li><a href="#installation">Installatie</a></li>
      </ul>
    </li>
    <li><a href="#contact">Contact</a></li>
  </ol>
</details>


## Over Dit Project

<h1>'t SAAM WEBSHOP</h1>

Dit is een webshop gecreërd door Benjamin Migom als deel van mijn stage. Dit project zal voorgesteld worden tijdens mijn pitch voor het eindwerk. </br>
Voor het schooljaar 2025 - 2026 zal deze webshop dan ook geimplementeerd worden als permanente webshop voor scholengroep 't Saam Diksmuide.

<p align="right">(<a href="#readme-top">terug naar boven</a>)</p>



### Gemaakt Met

* Livewire 3 v3.5.0
* Alpinejs
* Laravel 11 v11.10.0
* Tailwind
* PHP 8.2
* Composer
* NPM

<p align="right">(<a href="#readme-top">terug naar boven</a>)</p>

### Installatie

1. Clone the repo
   ```sh
   git clone 
   ```
2. Install COMPOSER packages
   ```sh
   composer install
   ```
3. Install NPM packages
   ```sh
   npm install
   ```
4. Setup .env bestand
   ```sh
   cp .env.example .env
   ```
5. Genereer project key
   ```sh
   php artisan key:generate
   ```

## Configure your .env file

### Stripe configuration
    STRIPE_KEY=your_stripe_key
    STRIPE_SECRET=your_stripe_secret
    STRIPE_WEBHOOK_SECRET=your_stripe_webhook_secret

## Run Project

1. Setup Database
   ```sh
   php artisan migrate:fresh --seed
   ```
2. Compile Assets
   ```sh
   npm run dev
   ```
3. Serv the Application
   ```sh
   php artisan serve
   ```

<p align="right">(<a href="#readme-top">terug naar boven</a>)</p>

<!-- CONTACT -->
## Contact

Benjamin Migom

Project Link: [https://github.com/BBENJA50/tsaamwebshop](https://github.com/BBENJA50/tsaamwebshop)

<p align="right">(<a href="#readme-top">terug naar boven</a>)</p>

