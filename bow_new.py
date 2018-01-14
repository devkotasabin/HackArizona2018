import pandas as pd
import re
import nltk
from nltk.corpus import stopwords
from sklearn.feature_extraction.text import CountVectorizer
import numpy as np

train = pd.read_csv("output_new.csv", header=0, delimiter="\t", quoting=3)
train.shape
train.columns.values
print train["tweet"][0]

def tweet_to_words(tweet):
	words = tweet.lower().split()
	stops = set(stopwords.words("english"))

	meaningful_words = [w for w in words if not w in stops]
	return( " ".join(meaningful_words ))

num_tweets = train["tweet"].size

clean_tweets = []
print "Cleaning and parsing the training set movie reviews...\n"

for i in xrange(0, num_tweets):
	# if( (i+1)%1000 == 0 ):
    #	print "Review %d of %d\n" % ( i+1, num_reviews )  
	clean_tweets.append( tweet_to_words(train["tweet"][i]))

#print clean_tweets

print "Creating the bag of words...\n"

vectorizer = CountVectorizer(analyzer = "word", 
	tokenizer = None,
	preprocessor = None,
	stop_words = None,
	max_features = 5000
	)

train_data_features = vectorizer.fit_transform(clean_tweets)

train_data_features = train_data_features.toarray()

print train_data_features.shape

vocab = vectorizer.get_feature_names()
print len(vocab)



dist = np.sum(train_data_features, axis = 0)

# a = 0

# for tag, count in zip(vocab, dist):
# 	#print count, tag
# 	a = 0

wordlist = pd.read_csv("wordlist.csv", header=0, delimiter=",", quoting=3)

list_indices = []

for i in xrange(0, len(vocab)):
	#list_indices[i] = -1
	list_indices.append(-1)
	for j in xrange(0, wordlist.shape[0]):
		if(vocab[i] == wordlist["word"][j]):
			list_indices[i] = j;

tweet_scores = []

for i in xrange(0, train_data_features.shape[0]):
	tweet_scores.append(0)
	for j in xrange(0, train_data_features.shape[1]):
		if list_indices[j] != -1:
			tweet_scores[i] += wordlist["score"][list_indices[j]]*train_data_features[i][j] 
	for k in xrange(8267, wordlist.shape[0]):
		if wordlist["word"][k] in clean_tweets[i]:
			tweet_scores[i] += wordlist["score"][k]


tweet_result = []



for i in xrange(0, len(tweet_scores)):
	tweet_result.append(0)
	if tweet_scores[i] < 0:
		tweet_result[i] = 1
	else:
		tweet_result[i] = 0

for i in xrange(0, len(tweet_result)):
	if(tweet_result[i]==1):
		print str(i) + "," + clean_tweets[i]


