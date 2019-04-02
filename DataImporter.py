import sys
import csv
from pymongo import MongoClient

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
    for i in range(FIRST_YEAR, LAST_YEAR + 1):
        data = 'tennis_atp-master/atp_matches_' + str(i) + '.csv'
        parsed_data = read_data(data, tourneys, matches, players)


def read_data(filename, tourneys, matches, players):
    with open(filename, 'r') as file:
        csv_reader = csv.reader(file, delimiter=',')
        for line in csv_reader:
            tourney_id = line[0]
            tourney_name = line[1]
            surface = line[2]
            tourney_date = line[5]
            result = db.profiles.create_index(
                [('user_id', pymongo.ASCENDING)], unique=True)
            if tourney_id not in tourney_dict:
                num_tourneys += 1
                tourney_dict.update({
                    tourney_id: (tourney_name, surface, tourney_date,
                                 num_tourneys)
                })
            winner_id = line[7]
            if winner_id not in player_dict:
                num_players += 1
                name = line[10]
                dominant_hand = line[11]
                height = line[12]
                country = line[13]
                rank = line[15]
                player_dict.update({
                    winner_id: (name, dominant_hand, height, country, rank,
                                num_players)
                })
            loser_id = line[17]
            if loser_id not in player_dict:
                num_players += 1
                name = line[20]
                dominant_hand = line[21]
                height = line[22]
                country = line[23]
                rank = line[24]
                player_dict.update({
                    loser_id: (name, dominant_hand, height, country, rank,
                               num_players)
                })
            match_id = line[6]
            if match_id not in match_dict:
                winner = players[winner_id][5]
                loser = players[loser_id][5]
                winner_seed = line[8]
                loser_seed = line[18]
                match_dict.update({
                    match_id: (winner, loser, winner_seed, loser_seed)
                })


if __name__ == "__main__":
    main()
