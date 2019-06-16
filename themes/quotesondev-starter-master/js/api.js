$(document).ready(function () {

    const HOME_PAGE = red_vars.home_url;
    const ARCHIVES_PAGE = red_vars.home_url + 'archives/';
    const CURRENT_PAGE = $(location).attr('href');

    $get_showPosts_btn = $('.my_btn');
    $get_post_content = $('.postContent');
    $get_post_author = $('.postAuthor');
    $get_post_cat = $('.postCategories');

    $get_form = $('.post-form');
    $get_submit_btn = $('.submitPostBtn');
    $get_title_quote = $('.authorText');
    $get_content_quote = $('.quoteTextarea');
    $get_archives_section = $('.archivesSection');
    $get_categ_section = $('.catgList');
    $get_tags_section = $('.tagsList');
    $get_authors_section = $('.authorsList');

    let ajResponse;

    const restUrls = {
        URL_RANDOM_POST: 'posts?filter[orderby]=rand&filter[posts_per_page]=1',
        URL_ALL_POSTS: 'posts?filter[orderby]=rand&filter[posts_per_page]=99',
        URL_CATEGORIES: 'categories',
        URL_TAGS: 'tags'
    };

    const typeCurrentUrl = {
        IS_URL_ALL_POSTS: 1,
        IS_URL_CATEGORIES: 2,
        IS_URL_TAGS: 3
    }
    let curUrl;


    (function () {

        if (CURRENT_PAGE == HOME_PAGE) {
            CallAjax(restUrls.URL_RANDOM_POST);

            $get_showPosts_btn.on('click', function (event) {
                event.preventDefault();
                var data;
                data = CallAjax(restUrls.URL_RANDOM_POST);
                console.log(data);
                FormatPost(data);
            })

            function FormatPost(posts) {
                //Select one random post
                // GetARandomPost(posts);
                let randPost = GetARandomPost(posts);
                let postContent = randPost.content.rendered;
                let postAuthor = randPost.title.rendered;
                // let postCategory = 
                $get_post_content.html($(postContent).text());
                $get_post_author.html(postAuthor + ',');
                $get_post_cat.html(FormatCategoriesLinks(randPost));


                // console.log(randPost);
                // $get_post_content.html(postContent);


            };

            function FormatCategoriesLinks(thePost) {

                let catsArray = [];
                let catsString = "";

                for (i = 0; i <= thePost.categories.length - 1; i++) {
                    catsArray.push(`<a class="cat_link" href="${thePost.category_link[i]}">${thePost.category[i].name}</a>`);

                }

                catsString = catsArray.join(', ');


                return catsString;
            }

            function GetARandomPost(posts) {
                // Convert as array if needed
                // for i as array index to the length of that array;
                // get a random i
                // select that index i from the array of posts
                // return that post
                // console.log(posts);
                var randIndex = randomIntFromInterval(0, posts.length - 1);
                return posts[randIndex];
            }

            function randomIntFromInterval(min, max) // min and max included
            {
                return Math.floor(Math.random() * (max - min + 1) + min);
            }

            function strip_html_tags(str) {
                if ((str === null) || (str === ''))
                    return false;
                else
                    str = str.toString();
                return str.replace(/<[^>]*>/g, '');
            }
        }

        if ($get_form) {
            $get_form.on('submit', function (event) {
                console.log('Test');

                // console.log(FormatPostToSend());
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: red_vars.rest_url + 'wp/v2/posts',
                    // dataType: 'json',
                    data: FormatPostToSend(),
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', red_vars.wpapi_nonce);
                        xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    },

                    success: function (response) {
                        // console.log(red_vars);
                        // console.log(response);
                        // console.log(FormatPost(response));
                        // FormatPostToSend(response);
                        console.log(response);
                        console.log(JSON.stringify(response));
                    },

                    failure: function () {
                        console.log('error');
                    }
                    // When everything is done:

                })

                    .done(function (response) {
                        $get_title_quote.val('');
                        $get_content_quote.val('');
                        // console.log('test');
                    })
                    .fail(function (code, status) {
                        // what you want to happen if the ajax request fails (404 error, timeout, etc.)
                        // 'code' is the numeric code, and 'status' is the text explanation for the error
                        // I usually just output some fancy error messages
                    })
                    .always(function (xhr, status) {
                        // what you want to have happen no matter if the response is success or error
                        // here, you would "stop" your loading animations, and maybe output a footer at the end of your content, reading "done"
                    });

            })

            function FormatPostToSend() {
                var dataToSend = '';
                var rawData = {
                    "title": $get_title_quote.val(),
                    "content": $get_content_quote.val(),
                    "status": "publish"
                };

                dataToSend = JSON.stringify(rawData);

                return dataToSend;
            }
        }


        if (CURRENT_PAGE == ARCHIVES_PAGE) {
            // FormatArchives();
            // console.log('...archives');

            FormatArchives();
            console.log('...');

        }

        function CallAjax(lastPartUrl) {

            $.ajax({
                method: 'GET',
                url: red_vars.rest_url + 'wp/v2/' + lastPartUrl,
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', red_vars.wpapi_nonce);
                }
            })
                .done(function (response) {
                    // console.log(red_vars);
                    // console.log(response);
                    // console.log(FormatPost(response));
                    // ajaxResponse = response;

                    ajResponse = response;
                    // console.log(ajResponse);
                    if (CURRENT_PAGE == HOME_PAGE) {
                        console.log('isHomePage');
                        FormatPost(ajResponse);
                    }
                    else if (CURRENT_PAGE == ARCHIVES_PAGE) {
                        console.log('isArchivesPage');
                        console.log(ajResponse);

                        switch (lastPartUrl) {
                            case restUrls.URL_ALL_POSTS:
                                ShowAuthors(ajResponse);
                                break;
                            case restUrls.URL_CATEGORIES:
                                ShowCats(ajResponse);
                                break;
                            case restUrls.URL_TAGS:
                                ShowTags(ajResponse);
                                break;
                        }

                    }
                    else {

                    }
                })
                .fail(function () {
                    console.log('error');
                })
                // When everything is done:
                .always(function () {
                    console.log('AJAX complete');
                });

            return ajResponse;
        }

        function FormatArchives() {

            FormatArchivesTags(restUrls.URL_TAGS);
            FormatArchivesAuthors(restUrls.URL_ALL_POSTS);
            FormatArchivesCat(restUrls.URL_CATEGORIES);
        }



        function FormatArchivesTags(url) {
            // curUrl = typeCurrentUrl.IS_URL_TAGS;
            CallAjax(url);

        }

        function FormatArchivesAuthors(url) {
            // curUrl = typeCurrentUrl.IS_URL_ALL_POSTS;
            CallAjax(url);

        }

        function FormatArchivesCat(url) {
            // curUrl = typeCurrentUrl.IS_URL_CATEGORIES;
            CallAjax(url);

        }

        function ShowCats(cats) {
            let catsArray = [];
            console.log('boom');
            $get_categ_section.html('');
            for (i = 0; i < cats.length - 1; i++) {
                $get_categ_section.append(`<span class="catgItem"><a href="${cats[i].link}">${cats[i].name}</a>  </span>`)
            }
        }

        function ShowTags(tags) {

            console.log('baam');
            $get_tags_section.html('');
            for (i = 0; i < tags.length - 1; i++) {
                $get_tags_section.append(`<span class="tagItem"><a href="${tags[i].link}">${tags[i].name}</a>  </span>`)
            }
        }

        function ShowAuthors(authors) {

            console.log('biim');
            $get_authors_section.html('');
            for (i = 0; i < authors.length - 1; i++) {
                $get_authors_section.append(`<span class="authorItem"><a href="${authors[i].link}">${authors[i].title.rendered}</a>  </span>`)
            }
        }






    })(jQuery);
});
