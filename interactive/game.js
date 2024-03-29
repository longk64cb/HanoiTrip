const question = document.getElementById('question');
const choices = Array.from(document.getElementsByClassName('choice-text'));
const progressText = document.getElementById('progressText');
const scoreText = document.getElementById('score');
const progressBarFull = document.getElementById('progressBarFull');
const loader = document.getElementById('loader');
const game = document.getElementById('game');
let currentQuestion = {};
let acceptingAnswers = false;
let score = 0;
let questionCounter = 0;
let availableQuesions = [];
const id = new URLSearchParams(window.location.search).get('id');
let questions = [];
var prefixs = document.querySelectorAll('.choice-prefix');
var texts = document.querySelectorAll('.choice-text');


fetch(`https://hcloud.trealet.com/tiny${id}/?json`)
    .then((res) => {
        return res.json();
    })
    .then((res) => {
        return fetch(res.image.url_full)
    })
    .then((res) => {return res.json()}) 
    .then((loadedQuestions) => {
        questions = loadedQuestions;
        startGame();
    })
    .catch((err) => {
        console.log(err);
        console.error(err);
    });

const CORRECT_BONUS = 10;
const MAX_QUESTIONS = 10;

startGame = () => {
    questionCounter = 0;
    score = 0;
    availableQuesions = [...questions];
    getNewQuestion();
    game.classList.remove('hidden');
    loader.remove();
};

getNewQuestion = () => {
    if (availableQuesions.length === 0 || questionCounter >= MAX_QUESTIONS) {
        localStorage.setItem('mostRecentScore', score);
        return window.location.assign(`./end.html?id=${id}`);
    }
    questionCounter++;
    progressText.innerText = `Câu hỏi ${questionCounter}/${MAX_QUESTIONS}`;
    progressBarFull.style.width = `${(questionCounter / MAX_QUESTIONS) * 100}%`;

    const questionIndex = Math.floor(Math.random() * availableQuesions.length);
    currentQuestion = availableQuesions[questionIndex];
    question.innerHTML = currentQuestion.question;

    choices.forEach((choice) => {
        const number = choice.dataset['number'];
        choice.innerHTML = currentQuestion['choice' + number];
    });

    availableQuesions.splice(questionIndex, 1);
    acceptingAnswers = true;
};

choices.forEach((choice) => {
    choice.addEventListener('click', (e) => {
        if (!acceptingAnswers) return;

        acceptingAnswers = false;
        const selectedChoice = e.target;
        const selectedAnswer = selectedChoice.dataset['number'];

        const classToApply =
            selectedAnswer == currentQuestion.answer ? 'correct' : 'incorrect';

        if (classToApply === 'correct') {
            incrementScore(CORRECT_BONUS);
        }

        selectedChoice.parentElement.childNodes[1].style.transform = 'none';
        selectedChoice.parentElement.childNodes[3].style.transform = 'none';

        selectedChoice.parentElement.classList.remove('choice-container');
        selectedChoice.parentElement.classList.add(classToApply);

        setTimeout(() => {
            selectedChoice.parentElement.classList.remove(classToApply);
            selectedChoice.parentElement.classList.add('choice-container');
            getNewQuestion();
        }, 1000);
    });
});

incrementScore = (num) => {
    score += num;
    scoreText.innerText = score;
};

function mouseEnter(i) {
    prefixs[i].style.transform = 'translateY(8px)'
    texts[i].style.transform = 'translateY(8px)'
}

function mouseLeave(i) {
    prefixs[i].style.transform = 'none'
    texts[i].style.transform = 'none'
}