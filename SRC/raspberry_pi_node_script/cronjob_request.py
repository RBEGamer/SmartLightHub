import urllib2
content = urllib2.urlopen("http://127.0.0.1/smarthome_v2/remote/cron.php").read()
print content