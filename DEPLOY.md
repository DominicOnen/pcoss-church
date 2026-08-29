# Deploying PCOSS

Two separate deployments, already connected via GitHub:

- **Frontend** (this repo) → Cloudflare Pages — static files only, no PHP/Python execution
- **Backend** (`pcoss-backend` repo) → Render — the FastAPI app

## 1. What changed in this pass

- Removed `gallery.php` and `contact.php` (PHP can't run on Cloudflare Pages —
  they were dead code). Their functionality now lives in `gallery.html` and
  `contact.html`, which call the FastAPI backend directly.
- Every page now loads `config.js` first, which defines `API_BASE_URL` —
  the one place to update if you ever move the backend.
- All `fetch_verses.php` / `fetch_data.php` calls now hit the real FastAPI
  endpoints (`/api/verses`, `/api/updates`, `/api/sermons`, `/api/gallery`).
- `admin-sermons.html` now has a password gate (enter the `ADMIN_KEY` you set
  on the backend) and its 4 forms actually submit to the API instead of to
  nonexistent `.php` files.
- Gallery uploads are now real files (stored on Cloudflare R2), not YouTube
  links — the gallery page renders native `<img>`/`<video>` accordingly.

## 2. Push the frontend

```bash
git add .
git commit -m "Wire site to FastAPI backend, remove dead PHP"
git push
```

Cloudflare Pages should pick it up automatically since it's connected to
this GitHub repo. Build settings: no build command needed (static site) —
output directory is the repo root.

## 3. Deploy the backend (Render)

The backend repo (`pcoss-backend`) has its own README with full steps. Short
version:

1. Push the new `main.py`, `requirements.txt`, `.gitignore`, `.env.example` to that repo.
2. On Render, set these environment variables (see `.env.example` for the full list):
   - `DATABASE_URL` — your Supabase connection string (**rotate the password first** — see security note below)
   - `ADMIN_KEY` — a long random string; this is the password `admin-sermons.html` will ask for
   - `R2_ACCOUNT_ID`, `R2_ACCESS_KEY_ID`, `R2_SECRET_ACCESS_KEY`, `R2_BUCKET_NAME`, `R2_PUBLIC_URL` — for gallery uploads
   - `RESEND_API_KEY`, `RESEND_TO_EMAIL`, `RESEND_FROM_EMAIL` — for contact form emails
3. Redeploy. Confirm `https://pcoss-backend.onrender.com/` returns `{"message": "PCOSS Church API is running!"}`.
4. If your Render service URL is ever different from `pcoss-backend.onrender.com`, update `config.js` in this repo to match.

## 4. One-time setup you still need to do

- **Cloudflare R2 bucket** (for gallery uploads): Cloudflare dashboard → R2 →
  Create bucket → enable public access (or attach a custom domain) → create
  an API token scoped to that bucket for `R2_ACCESS_KEY_ID`/`R2_SECRET_ACCESS_KEY`.
- **Resend account** (for contact form emails): sign up at resend.com, grab
  an API key. You can use their shared `onboarding@resend.dev` sender while
  testing, but verify your own domain for production so emails don't land
  in spam.
- **Rotate your Supabase database password.** A previous version of
  `main.py` had it hardcoded and committed to GitHub — treat it as
  compromised regardless of whether the repo is public or private.

## 5. Free-tier gotcha

Render's free web service tier spins down after inactivity, so the first
request after a while will be slow (10–50s) while it wakes up — the verse
sidebar or gallery may briefly show "Unable to load" before a retry. This
isn't a bug in the code; it's just cold-start latency. Upgrading the Render
plan removes it if it becomes annoying for visitors.
