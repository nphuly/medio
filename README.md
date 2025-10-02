# MedIO

## Story

This is a small clinic management project that I would like to dedicate to my uncle and the clinic of the monastery of Our Lady. 
The monastery clinic provides free examinations and treatments, and my uncle also works there without compensation. I hope this small project can be of help to them!

## How to use

1. Run `make init` to copy the `.env.${ENV}.example` & `.env.${ENV}` and generate Laravel key.
2. Run `make up` to run the Docker instances. You can pass the `ENV` with the desired value: `make up ENV=production`.
3. By default, `make up` will use the local environment to run, which also includes `migration` and `seed`. For other environments, please use:
   1. `make migrate` to run the migration.
   2. `make migrate-fresh` to run the fresh migration. **IMPORTANT: This will delete everything!**
   3. `make seed` to run the seeding.
4. After Docker is composed, you can access it via the browser with the URL `localhost/admin`
