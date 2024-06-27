<!-- TABLE OF CONTENTS -->
<details>
  <summary>Inhoudstafel</summary>
  <ol>
    <li>
      <a href="#over-dit-project">Over Dit Project</a>
      <ul>
        <li><a href="#gemaakt-met">Gemaakt Met</a></li>
      </ul>
    </li>
    <li>
      <ul>
        <li><a href="#installatie">Installatie</a></li>
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

## Configureer de .env file

### Stripe Configuratie
    STRIPE_KEY=your_stripe_key
    STRIPE_SECRET=your_stripe_secret

## Start het Project

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

## Details login

1. Admin login:
   - migom@hotmail.be
   - 12345678

<p align="right">(<a href="#readme-top">terug naar boven</a>)</p>

<!-- CONTACT -->
## Contact

Benjamin Migom

Project Link: [https://github.com/BBENJA50/tsaamwebshop](https://github.com/BBENJA50/tsaamwebshop)

<p align="right">(<a href="#readme-top">terug naar boven</a>)</p>

