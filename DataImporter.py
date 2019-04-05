import sys
import csv
from pymongo import MongoClient
import pymongo

FIRST_YEAR = 1968
LAST_YEAR = 2018


def main():
    client = MongoClient()
    client.drop_database('tennis')
    db = client['tennis']
    tourneys = db['tourneys']
    matches = db['matches']
    players = db['players']

    db.tourneys.create_index(
        [('name', pymongo.ASCENDING), ('date', pymongo.ASCENDING)],
        unique=True)
    db.players.create_index(
        [('name', pymongo.ASCENDING), ('height', pymongo.ASCENDING)],
        unique=True)
    for i in range(FIRST_YEAR, LAST_YEAR + 1):
        data = 'tennis_atp-master/atp_matches_' + str(i) + '.csv'
        read_data(data, db, tourneys, matches, players)


def read_data(filename, db, tourneys, matches, players):
    with open(filename, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        count = 0
        # tourney_id = 0
        # winner_id = -1
        # loser_id = -1
        for line in csv_reader:
            if count == 0:
                count += 1
                continue
            tourney_name = line[1]
            surface = line[2]
            tourney_date = line[5]
            try:
                tourney_id = tourneys.insert_one({
                    "name": tourney_name,
                    "surface": surface,
                    "date": tourney_date
                }).inserted_id
            except:

                tourney = tourneys.find_one({
                    "name": tourney_name,
                    "date": tourney_date
                })
                tourney_id = tourney.get('_id')

            name = line[10]
            dominant_hand = line[11]
            height = line[12]
            country = line[13]
            rank = line[15]
            try:
                winner_id = players.insert_one({
                    "name": name,
                    "hand": dominant_hand,
                    "height": height,
                    "country": country,
                    "rank": rank
                }).inserted_id
            except:
                winner_id = players.find_one({
                    "name": name,
                    "height": height
                }).get('_id')
            name = line[20]
            dominant_hand = line[21]
            height = line[22]
            country = line[23]
            rank = line[25]
            try:
                loser_id = players.insert_one({
                    "name": name,
                    "hand": dominant_hand,
                    "height": height,
                    "country": country,
                    "rank": rank
                }).inserted_id
            except:
                loser_id = players.find_one({
                    "name": name,
                    "height": height
                }).get('_id')
            try:
                matches.insert_one({
                    "winner": winner_id,
                    "loser": loser_id,
                    "tourney": tourney_id,
                    "winner seed": line[8],
                    "loser seed": line[18]
                })
            except:
                pass


if __name__ == "__main__":
    main()
