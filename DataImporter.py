import sys
import csv
from pymongo import MongoClient

FIRST_YEAR = 1968
LAST_YEAR = 2018


def main():
    client = MongoClient()
    db = client['TennisMatches']
    print 'here'
    tourney_dict = {}
    for i in range(FIRST_YEAR, LAST_YEAR + 1):
        print i
        print len(tourney_dict)
        data = 'tennis_atp-master/atp_matches_' + str(i) + '.csv'
        parsed_data = read_data(data, tourney_dict)


def read_data(filename, tourney_dict):
    with open(filename, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        for line in csv_reader:
            tourney_id = line[0]
            # print line
            if tourney_id not in tourney_dict:
                tourney_name = line[1]
                surface = line[2]
                tourney_date = line[5]
                tourney_dict.update({
                    tourney_id: (tourney_name, surface, tourney_date)
                })


if __name__ == "__main__":
    main()
