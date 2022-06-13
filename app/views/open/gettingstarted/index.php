<h1>Getting Started</h1>
<p>
    MVCzitto is a framework for PHP that allows you to build web applications in a simple and easy way. <a href="<?= BASE_URL ?>/user/login">Click here to check the login page example</a>.
</p>
<p>
    Instead of traditional OO Based MVC, we decided to implement MVC using File System Routing.
    The <strong>controller</strong> for this page, for example, is located at <code>app/controllers/open/gettingstarted/index.php</code> and the view is located at <code>app/views/open/gettingstarted/index.php</code>.
</p>
<p>
    You can take a look at the skeleton of the application:
</p>
<code><pre>
app
├── <strong>index.php</strong> (entry point - where de dependency injection is done)
├── <strong>config.php</strong> (configuration file)
├── assets
│   ├── css
│   │   └── style.css
│   └── images
│       └── logo-mvczitto.png
├── <strong>controllers</strong>
│   ├── <strong>authenticated</strong> (controllers that require authentication)
│   │   ├── dashboard
│   │   │   └── index.php
│   │   ├── index.php
│   │   └── user
│   │       ├── @(post)new.php
│   │       ├── edit
│   │       │   ├── @(put,patch)[id].php
│   │       │   └── [id].php
│   │       ├── logout.php
│   │       ├── new.php
│   │       └── profile.php
│   └── <strong>open</strong> (controllers that don't require authentication)
│       ├── gettingstarted
│       │   └── index.php
│       ├── index.php
│       └── user
│           ├── @(post)forgotpassword.php
│           ├── @(post)login.php
│           ├── @(post)signup.php
│           ├── forgotpassword.php
│           ├── index.php
│           ├── login.php
│           └── signup.php
└── <strong>views</strong> (follows the same pattern as controllers)
    ├── authenticated
    │   ├── footer.php
    │   ├── header.php
    │   └── user
    │       └── edit
    │           └── [id].php
    └── open
        ├── footer.php
        ├── gettingstarted
        │   └── index.php
        ├── header.php
        └── user
            ├── forgotpassword.php
            ├── login.php
            └── signup.php
</pre>
</code>