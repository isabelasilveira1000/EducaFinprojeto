
(() => {
  'use strict';

  document.querySelectorAll('[data-ef-quiz]').forEach((form) => {
    const questions = Array.from(
      form.querySelectorAll('.ef-quiz-question')
    );

    const result = form.querySelector('[data-ef-quiz-result]');
    const submit = form.querySelector('button[type="submit"]');
    const reset = form.querySelector('button[type="reset"]');

    if (!questions.length || !result || !submit || !reset) return;

    const updateProgress = () => {
      const answered = questions.filter(
        (question) => question.querySelector('input:checked')
      ).length;

      form.style.setProperty(
        '--ef-quiz-progress',
        `${(answered / questions.length) * 100}%`
      );

      form.dataset.answered = `${answered}/${questions.length}`;
    };

    form.addEventListener('change', updateProgress);

    form.addEventListener('submit', (event) => {
      event.preventDefault();

      let score = 0;
      let firstUnanswered = null;

      questions.forEach((question) => {
        const selected = question.querySelector('input:checked');

        if (!selected && !firstUnanswered) {
          firstUnanswered = question;
        }

        if (!selected) return;

        const correctIndex = Number(question.dataset.correct);
        const selectedIndex = Number(selected.value);
        const isCorrect = selectedIndex === correctIndex;

        if (isCorrect) score++;

        question.classList.toggle('is-correct', isCorrect);
        question.classList.toggle('is-incorrect', !isCorrect);

        question.querySelectorAll('.ef-quiz-option').forEach(
          (option, optionIndex) => {
            option.classList.toggle(
              'is-answer-correct',
              optionIndex === correctIndex
            );

            option.classList.toggle(
              'is-answer-wrong',
              optionIndex === selectedIndex && !isCorrect
            );

            const input = option.querySelector('input');

            if (input) input.disabled = true;
          }
        );

        const feedback = question.querySelector('.ef-quiz-feedback');

        if (feedback) {
          feedback.hidden = false;
          feedback.className =
            `ef-quiz-feedback ${isCorrect ? 'is-correct' : 'is-incorrect'}`;

          feedback.textContent =
            `${isCorrect ? 'Você acertou!' : 'Resposta correta destacada.'} ` +
            `${question.dataset.explanation || ''}`;
        }
      });

      if (firstUnanswered) {
        firstUnanswered.scrollIntoView({
          behavior: 'smooth',
          block: 'center'
        });

        const firstInput = firstUnanswered.querySelector('input');

        if (firstInput) {
          firstInput.focus({ preventScroll: true });
        }

        window.alert(
          'Responda a todas as questões antes de ver seu resultado.'
        );

        return;
      }

      const percent = Math.round(
        (score / questions.length) * 100
      );

      let message =
        'Continue estudando! Revisar o conteúdo pode ajudar na próxima tentativa.';

      if (score >= Math.ceil(questions.length * 0.8)) {
        message =
          'Excelente! Você demonstrou que compreendeu muito bem o conteúdo.';
      } else if (score >= Math.ceil(questions.length * 0.5)) {
        message =
          'Bom trabalho! Você está no caminho certo. Revise os pontos que geraram dúvidas.';
      }

      result.hidden = false;

      result.innerHTML =
        `<strong class="ef-result-score">${score}/${questions.length}</strong>` +
        `<span><b>${percent}% de aproveitamento</b><br>${message}</span>`;

      submit.disabled = true;
      submit.textContent = 'Quiz finalizado';

      result.scrollIntoView({
        behavior: 'smooth',
        block: 'center'
      });
    });

    reset.addEventListener('click', () => {
      window.setTimeout(() => {
        questions.forEach((question) => {
          question.classList.remove('is-correct', 'is-incorrect');

          question.querySelectorAll('.ef-quiz-option').forEach((option) => {
            option.classList.remove(
              'is-answer-correct',
              'is-answer-wrong'
            );

            const input = option.querySelector('input');

            if (input) input.disabled = false;
          });

          const feedback = question.querySelector('.ef-quiz-feedback');

          if (feedback) {
            feedback.hidden = true;
            feedback.textContent = '';
            feedback.className = 'ef-quiz-feedback';
          }
        });

        result.hidden = true;
        result.textContent = '';

        submit.disabled = false;
        submit.textContent = 'Ver meu resultado';

        updateProgress();
      }, 0);
    });

    updateProgress();
  });
})();
