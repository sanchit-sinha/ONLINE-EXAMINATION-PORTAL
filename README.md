# Register

## Register Page
1) Full Name(POST)
2) User Name(Unique user key) (POST)
3) Email Address (POST) 
5) Password (POST)
6) Confirm Password (POST)  

# Register -> Login

## Login Page
1) UserName/User ID
2) Password 
3) Add to session

# Register -> Login -> Course Profile
## Course Profile
1) Full Name(GET)
2) user name(GET)
3) Age(POST)
4) Gender(POST)
5) Email Address (GET)
6) List of enrolled courses with their instructor details(get)
7) Add course - Public, private course will require a key (POST)
8) Remove Course (POST)

# Register -> Login -> Courses Profile -> User
## User Profile 
1) Full Name(GET)  
2) Age (GET)
3) Gender (GET)
4) Course Name (GET)
5) Email Address (GET)
6) User Name (Unique UserID/Username) (GET)
7) Test Analysis (test score/ analysis) (GET)
8) Contributions to forums/ personal queries (GET)

## User Dashboard
1) Instuctor Blogs/ Materials (GET)
2) Course Notifications/ Digest (GET)
3) Suggestions for improvement (GET)
4) Tests(Live, upcoming)(GET)

## Tests
1) Attempted, Not Attempted, Upcoming, Live (GET)
2) Give Virtual(POST)
3) Mark favourite (POST)
4) Display total marks, score , complete analysis(GET)

## Discussion Forum (later)
1) Forums created by instructor/Students (GET)
2) Comments of other students/ Instructor (GET)
3) Add comments(POST)

## Contact Page/Form
1) Full Name(GET)
2) Course Name (GET)
3) Subject (POST)
4) Query Detail(POST)

## Exam Portal
1) Display questions and response sections for live tests(GET) 
2) Add bookmark/favourite(POST)