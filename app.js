

// models go here

var Post = Spine.Model.sub();

Post.configure( 'Post', 'author', 'title' );

Post.extend( Spine.Model.Ajax );


jQuery(function($){
	
	// controllers go here
	
	var Posts = Spine.Controller.sub({

    elements: { // the elements array
      ".posts": "posts",
      "input[type=text]": "input"
    },
    
    init: function() { // the init() method of the Controller
      Post.bind( 'refresh change', this.proxy( this.render )); // hook to the refresh and change events of the model
      Post.fetch(); // do a GET request to the server: /posts
    },
    
    render: function() {// the render() method of the Controller
      this.posts.html('');
      posts = Post.all(); // fetch all of the posts from the Model
      for (p in posts) // loop over each post
        this.posts.prepend(Mustache.to_html('<li>{{title}}</li>',posts[p])); // tpl is some Mustache HTML template data, '<li>{{title}}</li>'
    },
    
    events: { // the events array
      'click .create': 'create', // hook the click event of the button
    },
    
    create: function() { // the create() method of the Controller
      p = Post.create({ author:'', title:this.input.val() }); // create a new post with an author and title
      this.input.val(''); // erase the title from the text box
    }
    
  });
  
  return new Posts({el:$("#content")});
	
});


