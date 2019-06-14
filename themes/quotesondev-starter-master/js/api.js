$(document).ready(function () {
    // console.log('object');
    $get_posts_btn = $('.my_btn');
    $get_post_content = $('.postContent');
    $get_post_author = $('.postAuthor');
    $get_post_cat = $('.postCategories');

    (function () {
        if ($get_posts_btn) {
            $get_posts_btn.on('click', function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'GET',
                    url: red_vars.rest_url + 'wp/v2/posts?filter[orderby]=rand&filter[posts_per_page]=1',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', red_vars.wpapi_nonce);
                    }
                })
                    .done(function (response) {
                        // console.log(red_vars);
                        // console.log(response);
                        // console.log(FormatPost(response));
                        FormatPost(response);

                    })
                    .fail(function () {
                        console.log('error');
                    })
                    // When everything is done:
                    .always(function () {
                        console.log('AJAX complete');
                    });
            })
        }


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

    })(jQuery);
});
