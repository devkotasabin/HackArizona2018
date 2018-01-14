with open('all_output_depressing.txt') as f:
    lines = f.read().splitlines()
    
output_lines = []

with open('ids.txt') as f:
	ids = f.read().splitlines()
	
for i in xrange(0, len(ids)):
	output_lines.append(lines[int(ids[i])])

with open('all_output_depress_filtered.txt', 'w') as f:
	for i in xrange(0, len(output_lines)):
		f.write(output_lines[i]+'\n')