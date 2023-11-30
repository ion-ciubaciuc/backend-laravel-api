## Laravel App

### Prerequisites

Before you begin, make sure you have Docker installed on your machine:

- Docker: [Install Docker](https://docs.docker.com/get-docker/)

### Getting Started

1. **Clone the Repository:**

    ```bash
    git clone git@github.com:ion-ciubaciuc/backend-laravel-api.git
    ```

2. **Navigate to the Project Directory:**

    ```bash
    cd backend-laravel-api
    ```

3. **Create a Copy of the Environment File:**

    ```bash
    cp .env.example .env
    ```

4. **Build and Run the Docker Container:**

    ```bash
    docker-compose up -d --build
    ```


5. **Access the Laravel App:**

   Open your browser and visit [http://localhost:8000](http://localhost:8000)

   If everything is correct, you should see the installed Laravel version.


6. **Stop the Docker Container:**

    ```bash
    docker-compose down
    ```


