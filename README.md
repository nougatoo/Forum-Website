# CollierForum

Be sure to fetch from upstream before doing any work so you can have the most recent code base to work with.

Please be sure to commit and push any changes you make before leaving for the night. Unless the feature you are working on is not yet complete. In that case, don't push.

Also, please use 4 spaces for tabs.

## Connecting to the Database

I have created a database on my server for us to make use of. This will allow us to all interact with the same data and maintain consistency between DB setups.

<em><b>To connect, you need to know the following information:</b></em>
<ul>
  <li><b>Host:</b> zeeveener.com</li>
  <li><b>User:</b> collier</li>
  <li><b>Password:</b> rox</li>
  <li><b>Database:</b> collier</li>
</ul>

To connect from the command-line: 
```
mysql -h zeeveener.com -u collier -D collier -p
```
It will ask for the password, which you will type in and press enter.

<b>Congratulations, you have connected to the database! Go nuts!*<b>

<em>* I have made it so only I can drop a table, as the permissions to do that allow you to drop the whole database... So if you screw up while building a table, let me know and I will remove it for you.</em>
