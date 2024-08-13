import sqlite3
import csv
import sys
import os

def import_csv_to_table(cursor, table_name, csv_file):
    with open(csv_file, newline='', encoding='utf-8') as csvfile:
        reader = csv.reader(csvfile)
        header = next(reader)  # Пропускаем заголовок

        # Формируем SQL запрос для вставки данных
        placeholders = ', '.join(['?'] * len(header))
        insert_sql = f"INSERT INTO {table_name} ({', '.join(header)}) VALUES ({placeholders})"

        for row in reader:
            cursor.execute(insert_sql, row)

def main(database_file, tasks_csv, users_csv):
    try:
        connection = sqlite3.connect(database_file)
        cursor = connection.cursor()

        # Импорт данных в таблицу tasks
        import_csv_to_table(cursor, 'tasks', tasks_csv)

        # Импорт данных в таблицу users
        import_csv_to_table(cursor, 'users', users_csv)

        connection.commit()
        connection.close()

        print("Data has been successfully imported.")

    except sqlite3.Error as e:
        print(f"Error occurred: {e}")
        sys.exit(1)

    except Exception as e:
        print(f"General error occurred: {e}")
        sys.exit(1)

if __name__ == "__main__":
    if len(sys.argv) != 4:
        print("Usage: python3 import_from_csv.py <database_file> <tasks_csv_file> <users_csv_file>")
        sys.exit(1)

    database_file = sys.argv[1]
    tasks_csv = sys.argv[2]
    users_csv = sys.argv[3]

    # Проверка на существование файлов
    if not os.path.exists(database_file):
        print(f"Database file '{database_file}' does not exist.")
        sys.exit(1)

    if not os.path.exists(tasks_csv):
        print(f"Tasks CSV file '{tasks_csv}' does not exist.")
        sys.exit(1)

    if not os.path.exists(users_csv):
        print(f"Users CSV file '{users_csv}' does not exist.")
        sys.exit(1)

    main(database_file, tasks_csv, users_csv)
