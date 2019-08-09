function integrateGitalk(router) {
    const linkGitalk = document.createElement('link');
    linkGitalk.href = 'https://cdn.jsdelivr.net/npm/gitalk@1/dist/gitalk.css';
    linkGitalk.rel = 'stylesheet';
    document.body.appendChild(linkGitalk);
    const scriptGitalk = document.createElement('script');
    scriptGitalk.src = 'https://cdn.jsdelivr.net/npm/gitalk@1/dist/gitalk.min.js';
    document.body.appendChild(scriptGitalk);
  
    router.afterEach((to) => {
      if (scriptGitalk.onload) {
        loadGitalk(to);
      } else {
        scriptGitalk.onload = () => {
          loadGitalk(to);
        }
      }
    });
  
    function loadGitalk(to) {
      let commentsContainer = document.getElementById('gitalk-container');
      if (!commentsContainer) {
        commentsContainer = document.createElement('div');
        commentsContainer.id = 'gitalk-container';
        commentsContainer.classList.add('content');
      }
      const $page = document.querySelector('.page');
      if ($page) {
        $page.appendChild(commentsContainer);
        if (typeof Gitalk !== 'undefined' && Gitalk instanceof Function) {
          renderGitalk(to.fullPath);
        }
      }
    }
    function renderGitalk(fullPath) {
      const gitalk = new Gitalk({
        clientID: '3f3917e9e20836148568',
        clientSecret: '6ec40ea491bcc24248fb13909c470532c72a62f4', // come from github development
        repo: 'bquiz01',
        owner: 'rogeraabbccdd',
        admin: ['rogeraabbccdd'],
        id: 'comment',
        distractionFreeMode: false,
        language: 'zh-TW',
      });
      gitalk.render('gitalk-container');
    }
  }
  
  export default ({Vue, options, router}) => {
    try {
      document && integrateGitalk(router)
    } catch (e) {
      console.error(e.message)
    }
  }