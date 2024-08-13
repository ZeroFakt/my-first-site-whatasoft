import sqlite3
import csv
import sys

def export_table_to_csv(cursor, table_name, output_file):
    cursor.execute(f"SELECT * FROM {table_name}")
    rows = cursor.fetchall()

    with open(output_file, 'w', newline='', encoding='utf-8') as csvfile:
        writer = csv.writer(csvfile)
        # Write header
        writer.writerow([description[0] for description in cursor.description])
        # Write data
        writer.writerows(rows)

    print(f"Data from {table_name} has been exported to {output_file}.")

def main(database_file):
    try:
        connection = sqlite3.connect(database_file)
        cursor = connection.cursor()

        # Экспорт таблицы tasks
        export_table_to_csv(cursor, 'tasks', 'tasks_output.csv')

        # Экспорт таблицы users
        export_table_to_csv(cursor, 'users', 'users_output.csv')

        connection.close()

    except sqlite3.Error as e:
        print(f"Error occurred: {e}")
        sys.exit(1)

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python3 export_to_csv.py <database_file>")
        sys.exit(1)

    database_file = sys.argv[1]
    main(database_file)
