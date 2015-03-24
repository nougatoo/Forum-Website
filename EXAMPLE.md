I am going to use this file to show and explain a couple examples as to how we can build our relations with SQL queries.
Each table is equivalent to a relation.
Each table is created with one single query.

When writing queries for tables that contain a foreign key, the table containing the foreign key has to exist BEFORE the query will run.

For example, I will be using 2 tables that I have created for my SENG 301 program.
They are the User and Friendship tables.

They look something like this:

### User
| username (Primary Key) | password | email | name | age |
| -------- | -------- | ----- | ---- | --- |

In the database, that will look like this:

| Field    | Type         | Null | Key | Default | Extra |
|----------|--------------|------|-----|---------|-------|
| username | varchar(50)  | NO   | PRI | NULL    |       |
| password | varchar(50)  | NO   |     | NULL    |       |
| email    | varchar(125) | YES  |     | NULL    |       |
| name     | varchar(50)  | YES  |     | NULL    |       |
| age      | int(11)      | YES  |     | NULL    |       |

The SQL query used to build a structure like this would look like the following:

```sql
CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(125) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB
```

You want to put the text values between the weird single quotes, but it isn't necessary unless you find you are using a word that happens to mean something special in MySQL. The language won't tell you that though, it just won't work properly...

As you can see, we are using something called `VARCHAR(#)` for our text based values. This is basically a text section. If we are using text section that is larger than, say, 1024 characters, we will want to look at a larger, non-varchar option.

The `int(#)` defines an integer with a maximum of # digits. Simple enough.

Since in this program I want to make sure a user has their username and password, I will place the `NOT NULL` constraints on them. This is self explanatory. For the rest, you <em>DO NOT NEED</em> to use DEFAULT NULL as that is the default behaviour of MySQL anyways.

There are multiple ways to define when an attribute is a key or not. 
<br>The method used here calls the `PRIMARY KEY ('username')` AFTER username has already been defined. It is possible to use: `username varchar(50) PRIMARY KEY NOT NULL` as that will do the same thing.

The `ENGINE=InnoDB` is not important to know about, but does make a difference in very specific cases so I just use it always.

## Friendship

This is the schema for this relation

| inviter (Primary, Foreign) | invited (Primary, Foreign) | status |
| ----------------- | ----------------- | ------ |

In SQL, the table looks like this:

| Field | Type | Null | Key | Default | Extra |
| ----- | ---- | ---- | --- | ------- | ----- |
| inviter | varchar(50) | NO   | PRI | NULL    |       |
| invited | varchar(50) | NO   | PRI | NULL    |       |
| status  | varchar(10) | NO   |     | NULL    |       |

As you will see, the structure doesn't actually show that we have a foreign key constraint. However, you will notice with the SQL query below, that we do indeed put the constraint in there.

```sql
CREATE TABLE `friendship` (
  `inviter` varchar(50) NOT NULL,
  `invited` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`inviter`,`invited`),
  FOREIGN KEY (`inviter`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`invited`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB
```

Same reasoning above for the attribute types and constraints. The interesting parts here are that there are two primary keys and two foreign keys.

The `PRIMARY KEY (inviter, invited)` allows us to define both inviter and invited as our primary key. This means that the combination of both must be unique for the row to be added.

The `FOREIGN KEY (inviter) REFERENCES user (username) ON DELETE CASCADE ON UPDATE CASCADE` and `FOREIGN KEY (invited) REFERENCES user (username) ON DELETE CASCADE ON UPDATE CASCADE` are what define our Foreign Keys.

<ul>
  <li><b>FOREIGN KEY (inviter)</b> tells us we are defining a foreign key constraint on one of our attributes, in this case <em>inviter</em>.</li>
  <li><b>REFERENCES user (username)</b> tells us the attribute in the external relation that we are referencing. In This case, the username attribute from the user table.</li>
  <li><b>ON DELETE CASCADE ON UPDATE CASCADE</b> tell us that if the foreign key that one of these rows references is deleted or updated, copy those changes into this table. If a DELETE happens, any rows containing that foreign key are also deleted. Same logic applies if an UPDATE occurs.</li>
</ul>

Note that we MUST create the User table before the Friendship table. Otherwise, we will get errors and it won't complete for us.

These are two fairly simple examples which will likely encompass most if not all of our needs for this project.

If there are any other topics that we need to cover, let me know.
