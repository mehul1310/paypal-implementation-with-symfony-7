# PayPal Checkout Integration - Symfony 7

This project demonstrates how to integrate PayPal's checkout functionality into a Symfony 7 application, allowing users to make payments via PayPal. It includes both sandbox (for testing) and live environments.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)

---

## Prerequisites

Before you begin, ensure you have the following:

- PHP 8.2 or higher
- Symfony 7
- Composer
- PayPal Developer Account (for sandbox credentials)
- A valid PayPal business account for live transactions (when ready to go live)

---

## Installation

1. **Clone the Repository:**
    First, clone the repository to your local machine:
    ```bash
    git clone https://github.com/mehul1310/paypal-implementation-with-symfony-7.git
    cd paypal-implementation-with-symfony-7

2. **Install Dependencies:**
    ```bash
    composer install
   
## configuration

1. ***Configure Environment Variables:*
    Create a .env file in the root of the project (or use the existing .env file) and configure your PayPal credentials.
    ```bash
    PAYPAL_CLIENT_ID=your-sandbox-client-id
    PAYPAL_CLIENT_SECRET=your-sandbox-client-secret
    PAYPAL_ENVIRONMENT=sandbox
   
## Usage

1. **Start the Symfony Development Server:**
    ```bash
    symfony server:start
   
2. **Visit the Checkout Page:**
    ```bash
    http://localhost:8000/paypal/checkout

3. **Test Payments:**
   If you're in sandbox mode, log in using your sandbox PayPal credentials to simulate a transaction.