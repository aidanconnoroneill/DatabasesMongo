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
    player_dict = {}
    for i in range(FIRST_YEAR, LAST_YEAR + 1):
        print i
        print len(tourney_dict)
        data = 'tennis_atp-master/atp_matches_' + str(i) + '.csv'
        parsed_data = read_data(data, tourney_dict, player_dict)
    for id in tourney_dict:
        print tourney_dict[id]
    for id in player_dict:
        print player_dict[id]


def read_data(filename, tourney_dict, player_dict):
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
            winner_id = line[7]
            if winner_id not in player_dict:
                name = line[10]
                dominant_hand = line[11]
                height = line[12]
                country = line[13]
                rank = line[15]
                player_dict.update({
                    winner_id: (name, dominant_hand, height, country, rank)
                })
            loser_id = line[17]
            if loser_id not in player_dict:
                name = line[20]
                dominant_hand = line[21]
                height = line[22]
                country = line[23]
                rank = line[24]
                player_dict.update({
                    loser_id: (name, dominant_hand, height, country, rank)
                })


if __name__ == "__main__":
    main()
