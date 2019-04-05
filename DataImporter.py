import sys
import csv
from pymongo import MongoClient
import pymongo

FIRST_YEAR = 1968
LAST_YEAR = 2018


# Add match dictionary
# Foreign keys? John Dale wants to know
def main():
    client = MongoClient()
    db = client['tennis']
    tourneys = db['tourneys']
    matches = db['matches']
    players = db['players']
    result = db.tourneys.create_index(
        [('tourney_id', pymongo.ASCENDING)], unique=True)
    result = db.players.create_index(
        [('player_id', pymongo.ASCENDING)], unique=True)
    for i in range(FIRST_YEAR, LAST_YEAR + 1):
        data = 'tennis_atp-master/atp_matches_' + str(i) + '.csv'
        read_data(data, db, tourneys, matches, players)


def read_data(filename, db, tourneys, matches, players):
    with open(filename, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        count = 0
        tourney_id = -1
        winner_id = -1
        loser_id = -1

        try:
            tourney_id = tourneys.insert_one({
                "name": tourney_name,
                "surface": surface,
                "date": tourney_date
            }).inserted_id
        except:
            tourney_id = tourneys.find_one({
                "name": tourney_name,
                "surface": surface,
                "date": tourney_date
            })._id

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
                print("duplicate winner")
                pass
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
                print("duplicate looser")
                pass
            try:
                matches.insert_one({
                    "winner": winner_id,
                    "loser": loser_id,
                    "tourney": tourney_id,
                    "winner seed": line[8],
                    "loser seed": line[18]
                })
            except:

                print("duplicate match")
                pass

if __name__ == "__main__":
    main()
