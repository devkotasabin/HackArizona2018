import re

with open("output.json", "w") as output:
	with open("00.json","r") as inp:
		for line in inp:
			matchObj = re.match(r'.*"text":"(.*),"source":', line, re.I)
			if matchObj:
				output.write(matchObj.group(1) + "\n")
 