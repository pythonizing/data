#1 This is a command line based program that gives the definition of any Enlgish word 
#2 Copy the entire code below, paste it in a text file, and name the file english.py
#3 Copy the content of  www.pythonhow.com/data/data.json and paste it in a text file and name the file data.json
#4 Put the data.json file in the same folder with the english.py file
#5 Then open your terminal and  execute the program with the command "python english.py" and enjoy it!

import json
from difflib import get_close_matches

data = json.load(open("data.json"))

def translate(w):
    w = w.lower()
    if w in data:
        return data[w]
    elif len(get_close_matches(w, data.keys())) > 0:
        yn = input("Did you mean %s instead? Enter Y if yes, or N if no: " % get_close_matches(w, data.keys())[0])
        if yn == "Y":
            return data[get_close_matches(w, data.keys())[0]]
        elif yn == "N":
            return "The word doesn't exist. Please double check it."
        else:
            return "We didn't understand your entry."
    else:
        return "The word doesn't exist. Please double check it."

word = input("Enter word: ")
output = translate(word)
if type(output) == list:
    for item in output:
        print(item)
else:
    print(output)

