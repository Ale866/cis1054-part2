# Create a script that fetches sql files and import them into a sqlite3 database

import sqlite3
import os

env_vars = {} # or dict {}
with open('./.env') as f:
    for line in f:
        if line.startswith('#') or not line.strip():
            continue
        # if 'export' not in line:
        #     continue
        # Remove leading `export `, if you have those
        # then, split name / value pair
        # key, value = line.replace('export ', '', 1).strip().split('=', 1)
        key, value = line.strip().split('=', 1)
        env_vars[key] = value # Save to a dict, initialized env_vars = {}




DB_PATH=env_vars["DB_PATH"]
DDL_PATH='./lib/database/ddl/'

def erase_db():
    os.remove(DB_PATH)
    open(DB_PATH, 'w').close()

def import_db():
    # Connect to the database
    conn = sqlite3.connect(DB_PATH)
    c = conn.cursor()

    # Get all the sql files in the sql directory
    sql_files = [f for f in os.listdir(DDL_PATH) if f.endswith('.sql')]

    # Import each sql file into the database
    for sql_file in sql_files:
        with open(f'{DDL_PATH}{sql_file}', 'r') as f:
            sql = f.read()
            c.executescript(sql)

    # Commit the changes and close the connection
    conn.commit()
    conn.close()

if __name__ == '__main__':
    erase_db()
    import_db()