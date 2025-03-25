# CRISPR Designer

**CRISPR Designer** is a web application for generating CRISPR guides based on an input DNA sequence. Users can input their DNA sequences and select a PAM to get suitable CRISPR guides for gene editing.

## Description

This project allows users to generate CRISPR guides for input DNA sequences with different PAM sequences. The application uses a simple algorithm to identify sequences that match CRISPR editing requirements.

### Features:
- Input DNA sequence.
- Select PAM (e.g., `NGG` or `NAG`).
- Generate CRISPR guides.
- Download generated guides as a text file.

## Technologies Used
- **Laravel** — PHP framework for backend.
- **Tailwind CSS** — CSS framework for styling.
- **PHP** — Server-side logic.

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/CRIPSRGuide.git
   ```

2. Navigate to the project directory:

   ```bash
   cd crispr-designer
   ```

3. Install dependencies via Composer:

   ```bash
   composer install
   ```

4. Set up the `.env` file and configure your database:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. Run migrations to set up the database:

   ```bash
   php artisan migrate
   ```

6. Serve the application locally:

   ```bash
   php artisan serve
   ```

   The app should now be available at `http://localhost:8000`.

## Usage

1. Open the app in your browser.
2. Enter your DNA sequence in the provided input field.
3. Choose the desired PAM sequence (`NGG` or `NAG`).
4. Click **Generate Guides** to receive CRISPR guides.
5. You can download the generated guides as a `.txt` file.

## License

This project is open-source and available under the [MIT License](LICENSE).


