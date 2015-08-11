import sched, time
import urllib2

s = sched.scheduler(time.time, time.sleep)
def do_something(sc):
    #print "Doing stuff..."
    # do your stuff
    content = urllib2.urlopen("http://127.0.0.1/smarthome_v2/remote/cron.php").read()
    print content
    sc.enter(60, 1, do_something, (sc,))

s.enter(60, 1, do_something, (s,))
s.run()