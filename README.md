# run the project

- `docker build -t laravel-inventory-management .`
- `docker run  -p 8000:8000 -v ${PWD}:/app laravel-inventory-management` (windows powershell)
- `docker run  -p 8000:8000 -v $(pwd):/app laravel-inventory-management` (linux)

https://adminlte.io/themes/v3/pages/forms/general.html