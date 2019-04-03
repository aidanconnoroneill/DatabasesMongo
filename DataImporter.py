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
    result = db.profiles.create_index(
        [('tourney_id', pymongo.ASCENDING)], unique=True)
    for i in range(FIRST_YEAR, LAST_YEAR + 1):
        data = 'tennis_atp-master/atp_matches_' + str(i) + '.csv'
        parsed_data = read_data(data, db, tourneys, matches, players)


def read_data(filename, db, tourneys, matches, players):
    with open(filename, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        for line in csv_reader:
            tourney_name = line[1]
            surface = line[2]
            tourney_date = line[5]
            tourneys.insert_one({
                "name": tourney_name,
                "surface": surface,
                "date": tourney_date
            })
            name = line[10]
            dominant_hand = line[11]
            height = line[12]
            country = line[13]
            rank = line[15]
            players.insert_one({
                "name": name,
                "hand": dominant_hand,
                "height": height,
                "country": country,
                "rank": rank
            })
            name = line[20]
            dominant_hand = line[21]
            height = line[22]
            country = line[23]
            rank = line[25]
            players.insert_one({
                "name": name,
                "hand": dominant_hand,
                "height": height,
                "country": country,
                "rank": rank
            })

            # match_id = line[6]
            # if match_id not in match_dict:
            #     winner = players[winner_id][5]
            #     loser = players[loser_id][5]
            #     winner_seed = line[8]
            #     loser_seed = line[18]
            #     match_dict.update({
            #         match_id: (winner, loser, winner_seed, loser_seed)
            #     })


if __name__ == "__main__":
    main()
