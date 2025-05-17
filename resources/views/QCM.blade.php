@extends('Layouts.StudentsLayout')

@section('content')
<div class="p-4">
    <div class="container mx-auto py-5">
        <!-- Subject Selection Section -->
        <div id="subjectSelection" class="text-center">
            <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Select a Subject</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="card subject-card" data-subject="python">
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">Python</h5>
                    </div>
                </div>
                <div class="card subject-card" data-subject="css">
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">CSS</h5>
                    </div>
                </div>
                <div class="card subject-card" data-subject="js">
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">JavaScript</h5>
                    </div>
                </div>
                <div class="card subject-card" data-subject="react">
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">React</h5>
                    </div>
                </div>
                <div class="card subject-card" data-subject="php">
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">PHP</h5>
                    </div>
                </div>
                <div class="card subject-card" data-subject="laravel">
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <h5 class="text-xl font-semibold text-gray-900 dark:text-white">Laravel</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Section -->
        <div id="quizSection" class="mt-4 hidden">
            <div class="flex justify-between items-center mb-4">
                <h3 id="currentSubject" class="text-xl font-bold text-gray-900 dark:text-white"></h3>
                <div class="timer text-xl font-bold text-red-500" id="timer">10</div>
            </div>
            <div id="questionsContainer"></div>
        </div>
    </div>
</div>

<style>
    .subject-card {
        cursor: pointer;
        transition: transform 0.2s;
    }
    .subject-card:hover {
        transform: scale(1.05);
    }
    .timer {
        font-size: 1.5rem;
        color: #ef4444;
        font-weight: bold;
    }
    .list-group-item {
        background-color: white;
        border: 1px solid #e5e7eb;
        color: #1f2937;
        font-size: 1.1rem;
        padding: 1rem;
        margin-bottom: 0.5rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    .list-group-item:hover {
        background-color: #f3f4f6;
    }
    .list-group-item:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }
    .list-group-item-success {
        background-color: #10b981 !important;
        color: white !important;
    }
    .list-group-item-danger {
        background-color: #ef4444 !important;
        color: white !important;
    }
    .score-display {
        font-size: 2.5rem;
        color: #10b981;
        margin: 20px 0;
        font-weight: bold;
    }
    .dark .list-group-item {
        background-color: #1f2937;
        border-color: #374151;
        color: #f3f4f6;
    }
    .dark .list-group-item:hover {
        background-color: #374151;
    }
</style>

<script>
    const questions = {
        python: [
            {
                question: "What is Python?",
                options: ["A snake species", "A programming language", "A database system", "A web browser"],
                correct: 1
            },
            {
                question: "Which of the following is used to create a comment in Python?",
                options: ["//", "/* */", "#", "<!-- -->"],
                correct: 2
            },
            {
                question: "What is the correct way to create a variable in Python?",
                options: ["var x = 5", "x = 5", "let x = 5", "const x = 5"],
                correct: 1
            },
            {
                question: "Which of the following is a Python data type?",
                options: ["Array", "List", "Vector", "Matrix"],
                correct: 1
            },
            {
                question: "What is the output of print(type([]))?",
                options: ["<class 'array'>", "<class 'list'>", "<class 'tuple'>", "<class 'set'>"],
                correct: 1
            },
            {
                question: "Which method is used to add an element to a list in Python?",
                options: ["push()", "add()", "append()", "insert()"],
                correct: 2
            },
            {
                question: "What is the correct way to create a function in Python?",
                options: ["function myFunc()", "def myFunc()", "create myFunc()", "func myFunc()"],
                correct: 1
            },
            {
                question: "Which operator is used for exponentiation in Python?",
                options: ["^", "**", "pow", "exp"],
                correct: 1
            }
        ],
        css: [
            {
                question: "What does CSS stand for?",
                options: ["Computer Style Sheets", "Creative Style Sheets", "Cascading Style Sheets", "Colorful Style Sheets"],
                correct: 2
            },
            {
                question: "Which property is used to change the background color?",
                options: ["color", "bgcolor", "background-color", "background"],
                correct: 2
            },
            {
                question: "Which CSS property is used to change the text color?",
                options: ["text-color", "color", "font-color", "text-style"],
                correct: 1
            },
            {
                question: "Which CSS property is used to change the font of an element?",
                options: ["font-family", "font-style", "font-weight", "font-type"],
                correct: 0
            },
            {
                question: "Which CSS property is used to add space between the border and content?",
                options: ["margin", "padding", "spacing", "border-space"],
                correct: 1
            },
            {
                question: "Which CSS property is used to make text bold?",
                options: ["font-weight", "text-weight", "font-bold", "text-style"],
                correct: 0
            },
            {
                question: "Which CSS property is used to add rounded corners to elements?",
                options: ["border-radius", "corner-radius", "border-round", "round-corners"],
                correct: 0
            },
            {
                question: "Which CSS property is used to create space between elements?",
                options: ["padding", "margin", "spacing", "gap"],
                correct: 1
            }
        ],
        js: [
            {
                question: "Which of the following is not a JavaScript data type?",
                options: ["String", "Boolean", "Integer", "Object"],
                correct: 2
            },
            {
                question: "How do you declare a variable in JavaScript?",
                options: ["variable x;", "v x;", "let x;", "x = variable;"],
                correct: 2
            },
            {
                question: "Which operator is used to assign a value to a variable?",
                options: ["*", "=", "==", "==="],
                correct: 1
            },
            {
                question: "Which method is used to add an element to the end of an array?",
                options: ["push()", "append()", "add()", "insert()"],
                correct: 0
            },
            {
                question: "Which event occurs when the user clicks on an HTML element?",
                options: ["onmouseover", "onclick", "onchange", "onmouseclick"],
                correct: 1
            },
            {
                question: "How do you create a function in JavaScript?",
                options: ["function myFunction()", "function:myFunction()", "function = myFunction()", "function => myFunction()"],
                correct: 0
            },
            {
                question: "Which method is used to remove the last element from an array?",
                options: ["remove()", "delete()", "pop()", "shift()"],
                correct: 2
            },
            {
                question: "Which operator is used to compare both value and type?",
                options: ["=", "==", "===", "=>"],
                correct: 2
            }
        ],
        react: [
            {
                question: "What is React?",
                options: ["A database", "A programming language", "A JavaScript library", "A server"],
                correct: 2
            },
            {
                question: "Which hook is used for side effects in React?",
                options: ["useState", "useEffect", "useContext", "useReducer"],
                correct: 1
            },
            {
                question: "What is the correct way to create a React component?",
                options: ["function Component()", "class Component", "component Component()", "createComponent()"],
                correct: 0
            },
            {
                question: "Which method is used to render React components?",
                options: ["ReactDOM.render()", "React.render()", "render()", "DOM.render()"],
                correct: 0
            },
            {
                question: "What is JSX?",
                options: ["A database", "A styling language", "A syntax extension for JavaScript", "A testing framework"],
                correct: 2
            },
            {
                question: "Which hook is used to manage state in functional components?",
                options: ["useState", "useEffect", "useContext", "useReducer"],
                correct: 0
            },
            {
                question: "What is the purpose of the key prop in React?",
                options: ["To style elements", "To identify unique elements in a list", "To create links", "To handle events"],
                correct: 1
            },
            {
                question: "Which method is used to update state in React?",
                options: ["this.setState()", "setState()", "updateState()", "changeState()"],
                correct: 1
            }
        ],
        php: [
            {
                question: "What does PHP stand for?",
                options: ["Personal Home Page", "PHP Hypertext Preprocessor", "Private Home Page", "Public Home Page"],
                correct: 1
            },
            {
                question: "Which symbol is used to start a PHP variable?",
                options: ["@", "#", "$", "&"],
                correct: 2
            },
            {
                question: "Which PHP function is used to output text?",
                options: ["print()", "echo()", "write()", "output()"],
                correct: 1
            },
            {
                question: "Which PHP function is used to get the length of a string?",
                options: ["length()", "strlen()", "count()", "size()"],
                correct: 1
            },
            {
                question: "Which PHP function is used to convert a string to lowercase?",
                options: ["lowercase()", "strtolower()", "toLower()", "lower()"],
                correct: 1
            },
            {
                question: "Which PHP function is used to get the current date and time?",
                options: ["time()", "date()", "now()", "datetime()"],
                correct: 1
            },
            {
                question: "Which PHP function is used to include a file?",
                options: ["include()", "require()", "import()", "Both A and B"],
                correct: 3
            },
            {
                question: "Which PHP function is used to create an array?",
                options: ["createArray()", "array()", "newArray()", "makeArray()"],
                correct: 1
            }
        ],
        laravel: [
            {
                question: "Laravel is a framework for which language?",
                options: ["JavaScript", "Python", "PHP", "Ruby"],
                correct: 2
            },
            {
                question: "Which command is used to create a new Laravel project?",
                options: ["laravel new", "composer create-project", "php artisan new", "laravel create"],
                correct: 1
            },
            {
                question: "Which command is used to start the Laravel development server?",
                options: ["php start", "php artisan serve", "laravel serve", "php server"],
                correct: 1
            },
            {
                question: "Which file is used to define database migrations in Laravel?",
                options: ["database.php", "migration.php", "schema.php", "migrations folder"],
                correct: 3
            },
            {
                question: "Which command is used to create a new controller in Laravel?",
                options: ["php make controller", "php artisan make:controller", "laravel make controller", "php create controller"],
                correct: 1
            },
            {
                question: "Which method is used to define a route in Laravel?",
                options: ["Route::get()", "get()", "route()", "defineRoute()"],
                correct: 0
            },
            {
                question: "Which command is used to create a new model in Laravel?",
                options: ["php make model", "php artisan make:model", "laravel make model", "php create model"],
                correct: 1
            },
            {
                question: "Which file is used to define database configuration in Laravel?",
                options: ["config.php", "database.php", ".env", "db.php"],
                correct: 2
            }
        ]
    };

    let currentSubject = '';
    let currentQuestion = 0;
    let timer;
    let timeLeft = 10;
    let score = 0;

    document.querySelectorAll('.subject-card').forEach(card => {
        card.addEventListener('click', () => {
            currentSubject = card.dataset.subject;
            document.getElementById('subjectSelection').style.display = 'none';
            document.getElementById('quizSection').style.display = 'block';
            document.getElementById('currentSubject').textContent = currentSubject.toUpperCase();
            startQuiz();
        });
    });

    function startQuiz() {
        currentQuestion = 0;
        score = 0;
        displayQuestion();
        startTimer();
    }

    function displayQuestion() {
        const question = questions[currentSubject][currentQuestion];
        const container = document.getElementById('questionsContainer');
        
        container.innerHTML = `
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <h5 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Question ${currentQuestion + 1} of ${questions[currentSubject].length}</h5>
                <p class="text-lg mb-6 text-gray-700 dark:text-gray-300">${question.question}</p>
                <div class="space-y-3">
                    ${question.options.map((option, index) => `
                        <button class="w-full text-left p-4 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors list-group-item" onclick="checkAnswer(${index})">
                            ${option}
                        </button>
                    `).join('')}
                </div>
            </div>
        `;
    }

    function startTimer() {
        timeLeft = 10;
        document.getElementById('timer').textContent = timeLeft;
        
        clearInterval(timer);
        timer = setInterval(() => {
            timeLeft--;
            document.getElementById('timer').textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                nextQuestion();
            }
        }, 1000);
    }

    function checkAnswer(selectedIndex) {
        clearInterval(timer);
        const question = questions[currentSubject][currentQuestion];
        const buttons = document.querySelectorAll('.list-group-item');
        
        buttons.forEach(button => button.disabled = true);
        
        if (selectedIndex === question.correct) {
            buttons[selectedIndex].classList.add('list-group-item-success');
            score++;
        } else {
            buttons[selectedIndex].classList.add('list-group-item-danger');
            buttons[question.correct].classList.add('list-group-item-success');
        }
        
        setTimeout(nextQuestion, 1000);
    }

    function nextQuestion() {
        currentQuestion++;
        if (currentQuestion < questions[currentSubject].length) {
            displayQuestion();
            startTimer();
        } else {
            const percentage = (score / questions[currentSubject].length) * 100;
            document.getElementById('quizSection').innerHTML = `
                <div class="text-center">
                    <h3>Quiz Completed!</h3>
                    <div class="score-display">
                        Your Score: ${score}/${questions[currentSubject].length} (${percentage.toFixed(1)}%)
                    </div>
                    <button class="btn btn-primary mt-3" onclick="location.reload()">Start New Quiz</button>
                </div>
            `;
        }
    }
</script>
@endsection
