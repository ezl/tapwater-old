# Tap Safe

## Local Development

Docker Compose is used to run the site locally.

To run it,

```
docker-compose up
```

After making changes to the `docker-compose.yml` file (e.g. updating an env variable) be sure to rebuild the container:

```
docker-compose up --build
```

To download and reimport the production database into your local environment, run the following (TODO: script not available yet):

`scripts/sync-down`
