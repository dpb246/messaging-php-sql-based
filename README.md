# messaging
PHP based 1 room chat server
SQL handles user accounts and messages
Javascript refreshes chat

DATABASE INFO:
  Two databases:
  1. messages
    id - primary key
    user_id - int
    message - varchar(150)
    time - timestamp
  2. users
    userid - primary key
    username - varchar(24)
    password - varchar(24)
    active - boolean
    admin - boolean
