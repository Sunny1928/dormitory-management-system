import pymysql
import argparse

class init_sql:
    
    def __create_table(cursor):

        # create sql table
        data = open("./init_sql/build_sql.sql","r")
        for command in data.read().split(";"):
            if command == "":
                continue
            cursor.execute(command)

    def __create_data(cursor):

        # insert initial data 
        data = open("./init_sql/init_table.txt","r",encoding="utf-8")
        line = data.readline()

        while line:

            if line == "\n":
                line = data.readline()
                continue
            # dormitory processing 
            if line[0]!="I":
                split_line = line.split(",")
                
                if split_line[0] == "dormitory":

                    fee = split_line[1] 
                    
                    for dormitory_id_idx in range(4):
                        
                        dormitory_id = int(split_line[3]) + dormitory_id_idx
                        
                        # 學二 fee
                        if dormitory_id_idx >= 2 :
                            fee = 9985
                        
                        for room_number_idx in range(10):
                            room_number= int(split_line[2]) + room_number_idx
                            # insert room 
                            command = f"INSERT INTO `room`(`num_of_people`, `fee`, `room_number`, `dormitory_id`) VALUES ('4','{fee}','{room_number}','{dormitory_id}');"
                            cursor.execute(command)
                            for _ in range(4):
                                # insert equipment-bed
                                command = f"INSERT INTO `equipment`(`expired_year`, `name`, `room_number`, `dormitory_id`) VALUES ('2','bed','{room_number}','{dormitory_id}');"
                                cursor.execute(command)
                                # insert equipment-lamp
                                command = f"INSERT INTO `equipment`(`expired_year`, `name`, `room_number`, `dormitory_id`) VALUES ('2','lamp','{room_number}','{dormitory_id}');"
                                cursor.execute(command)
            else :
                cursor.execute(line)
            line = data.readline()
            
    def __delete_table(cursor):

        data = open("./init_sql/table_name.txt","r")
        line = data.readline()

        while line:
            # remove "\n"
            line=line.strip('\n')
            # close foreign key check
            command ="SET FOREIGN_KEY_CHECKS = 0;"
            cursor.execute(command)
            command = f"DROP TABLE IF EXISTS `{line}`;"
            cursor.execute(command)
            line = data.readline()
        # open foreign key check
        command ="SET FOREIGN_KEY_CHECKS = 1;"
        cursor.execute(command)

    def __delete_data(cursor):

        data = open("./init_sql/table_name.txt","r")
        line = data.readline()

        while line:
            # remove "\n"
            line=line.strip('\n')
            # close foreign key check
            command ="SET FOREIGN_KEY_CHECKS = 0;"
            cursor.execute(command)
            command = f"DELETE FROM `{line}`;"
            cursor.execute(command)
            line = data.readline()
        # open foreign key check
        command ="SET FOREIGN_KEY_CHECKS = 1;"
        cursor.execute(command)

    def create_all(cursor):
        init_sql.__create_table(cursor)
        init_sql.__create_data(cursor)


    def delete_all(cursor):
        init_sql.__delete_data(cursor)
        init_sql.__delete_table(cursor)

def main(opt):

    args = vars(opt)
    
    conn = pymysql.connect(host=args["host"],port=args["port"], user=args["user"], password=args["password"], database=args["database"])
    cursor = conn.cursor()
    if args["mode"] == 'c':
        # create table & data
        init_sql.create_all(cursor)
    else:
        # delete table & data
        init_sql.delete_all(cursor)
    conn.commit()
    conn.close()

def parse_opt(known = False):

    parser = argparse.ArgumentParser()
    parser.add_argument("--mode",type=str, default = 'c')
    parser.add_argument("--host",type=str, default = '127.0.0.1')
    parser.add_argument("--port",type= int  , default=3307)
    parser.add_argument("--user",type=str, default = 'root')
    parser.add_argument("--password",type=str, default = '12345678')
    parser.add_argument("--database",type=str, default = 'nukdms')


    return parser.parse_known_args()[0] if known else parser.parse_args()


if __name__ == "__main__":

    opt = parse_opt()
    main(opt)
    


