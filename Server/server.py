import json
import os 

os.system("curl  http://localhost:4040/api/tunnels > Log/tunnels.json")

with open('Log/tunnels.json') as data_file:    
	datajson = json.load(data_file)

print

msg = "ngrok URL's: \n"
for i in datajson['tunnels']:
	msg = msg + i['public_url'] +'\n'

print (msg)

file = open("Log/ip.txt","w") 
 
file.write(msg) 
