" HTML
let g:emmet_html5 = 0

" PHP
augroup web_indentation
  autocmd!
  autocmd FileType php,css,javascript setlocal shiftwidth=4
augroup END

" Symfony
set wildignore+=*/var/*,*/vendor/*,*/public/build/*
