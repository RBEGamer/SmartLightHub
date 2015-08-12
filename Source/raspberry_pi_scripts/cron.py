import sched, time
import urllib2

print "starting smarthub cronjob"
s = sched.scheduler(time.time, time.sleep)
def do_something(sc):
    content = urllib2.urlopen("http://127.0.0.1/smarthome_v2/remote/cron.php").read()
    print content
    sc.enter(60, 1, do_something, (sc,))

s.enter(60, 1, do_something, (s,))
s.run()