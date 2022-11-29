# Instructions

## Running PHP file

1. **Open terminal/command prompt**
1. **cd to project directory**
1. **Run this command to start the built-in PHP server:** `php -S localhost:8000`
1. **Open browser and type into the address bar:** `localhost:8000`

Note: the default file that loads is *index.php*, so make sure that is the filename of the starting page

## Database Connection

*DBHandler.php* deals with connecting to the database. Be sure to modify the `$username` and `$password` fields!

## Importing data to MySQL

I created a file `GamePlatformImport.sql` that automatically populates the database tables.
Instructions to run the script:

1. Open MySQL Workbench
2. Select `Server -> Import Data` from the top navigation menu
3. In the import options, select **Import from Self-Contained File** and select `GamePlatformImport.sql`
4. Select the **Default Target Schema**. This is the database that the data from the script will be imported to
5. Switch to the **Import Status** tab and click **Import** at the bottom right of the window
