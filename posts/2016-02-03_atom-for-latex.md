{
  "title":"Atom for LaTeX editing",
  "author":"admin",
  "tags":[
    "LaTeX",
    "Atom"
  ],
  "image":"/public/content/header-atom-for-latex.png"
}
---:endmetadata:---
After having done the experimental work required for my master thesis, I finally decided to start writing it (considering that my graduation is scheduled for next March I think it is time to do it 😁) and, _of course_, I decided to write it with __LaTeX__.

> Ah the simplicity and beauty of the old good LaTeX!

But where do I have to start from? Firstly I'd need the environment, then a good editor (maybe with integrated controls for compiling and 💩), then a good and light PDF reader.
For you to know, I'm running Mac OS X as you can see from the figure below.

![My Mac](/public/content/my-mac.png)

Ok, I already had the environment set up so fuck it, first problem solved. Preview on the Mac is a very good PDF reader so no extra need of other software but... how am I supposed to write my thesis??? Here comes the story.

I remember that when I wrote my bachelor's degree thesis I did it using _TeXworks_ but I remember as well that it has been a huge pain in the ass. So, I started to look for a different editor, maybe one with integrated controls for compiling, bibliography etc...

I found _TeXnicle_, a very good piece of software, __free__ and rich of features so I thought that my research was over. I downloaded it and used it a bit but I also found out that I was not liking it. Maybe too many crashes or not so clear UI, I don't know very well. I didn't like it (yes I know I am strange 😁).
I decided to give a try to _Texpad_ from the Mac App Store, a very good and complete native app for writing LaTeX documents. I download the trial version and I used it a bit. I really like it, extremely well done.

> But, eventually, every trial comes to an end.

_Texpad_ costs _27.99 €_, and that is too much for my poor and empty pockets. Of course I have tried to download a cracked version of it!!! I am joking 👼 (no I'm not 😈).

Then, I said to myself: "Hey you, why don't you try to customize Atom, it is a very good editor for development and it has a plethora of very well done packages that could help you with almost everything!". And so I did. I'm writing this blog post to share my set up with you in case you are in the same position in which I was some days ago.

I will show you the result of my configuration, my Atom looks like this at the moment:

![atom-latex-look-like](/public/content/atom-latex-look-like.png)

To change UI colors and theme I used a package called _Atom Material_ both for UI and for syntax, check it out, it's amazing.

To obtain support for transforming Atom into a fully featured LaTeX editor I installed the following packages:

- __autocomplete-bibtex__: this gives you the possibility to use snippets and advices as you type in your bibliography file. Of course you need to have installed __autocomplete-plus__ package into your atom environment, but everyone has got it so you probably already have got it.
- __language-latex__: this is to add syntax highlighting for LaTeX to Atom. A very good package.
- __linter-chktex__: this is a linter that uses chktex and it is useful before compiling to avoid committing errors and to avoid warnings.
- __spell-check__: this is to obtain a spell check analysis to avoid committing linguistic errors (only works with english). You must then activate the analysis for `.tex` files otherwise it will not work.
- __latexer__: for adding another layer of LaTeX completion suggestions.
- __latex-plus__: for adding the compiling features, a very handful `cmd+:` shortcut to compile your project.
- __pdf-view__: to allow Atom to open and view PDF file inside an editor tab instead of launching the default system application for displaying this kind of files.

Along these necessary packages, I found very useful having installed these other handful extensions.

- __dictionary__: this package integrates Mac OS X Dictionary.app inside Atom. With a `^+cmd+k` shortcut you can fire the dictionary application on the word on which the caret is on. Handful, right?
- __zen__: distraction-free writing sometimes is what you need, just `^+cmd+z` and enter the zen modality, nothing will distract you from writing anymore.
- __wordcount__: need to be careful about the words you are writing? You solved your problems man. _Be careful as this package does not ignore LaTeX language tokens_.
- __git-plus__: gives to Atom the ability to git add push commit even single files or the whole project, sometimes it fits the situation, some others not but it is worth a try.
- __project-manager__: organize the projects you are working on and efficiently switch among them all in a while. I find it useful 😉.
- __minimap__: this package shows a mini map of the current file you are editing, very useful to visually scroll large files.

To customize a bit my new LaTeX editor I decided to remove the line numbers from the viewport cause I don't need them. So I had to add the following to my Atom `styles.less` file.

```css
atom-text-editor {
  &[data-grammar~=latex]::shadow {
    .gutter-container {
      display: none !important;
    }
  }
}
```

That's all for now! I hope you enjoyed the reading and I hope to finish my thesis soon 😂. If you have questions of curiosities about this article just use the comment section below. I leave you some images that will let you have a sneak peak of how Atom will look like and what will be the possible configurations of some packages.

Bye-bye! 👋👋👋

#### Example of wordcount package

![atom-wordcount](/public/content/atom-wordcount.png)

#### Configuration screen shot of latex-plus package

![atom-latex-plus](/public/content/atom-latex-plus.png)

#### Usage example of git-plus package

![atom-git-plus](/public/content/atom-git-plus.png)
