# digikam-web
Web-based browsing using the DikiKam Photo Database

Too old, better to start with a new Symfony 7.2 project and run the app:create-dk-entities command.

Maybe keep imageService and Flickr, maybe not.

USE sf-7 branch!!



# Requirements



Configure Digikam 6 to use a MySQL (or MariaDB) database, either locally or remote.  You'll need the credentials.

sqlite3 ~/Pictures/digikam4.db .schema > schema.sql


## Heroku Deployment

One easy way to deploy this app with your photo database is via Heroku.

     heroku addons:create jawsdb-maria:kitefin
