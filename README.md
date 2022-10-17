
[<img src="https://docs.lemurengine.com/assets/images/lemur-med.png" width="100"/>](https://docs.lemurengine.com/assets/images/lemur-med.png)
# emurengine/lemurtag-googlesearch


Add a AIML tag to your Lemur Engine chatbot to allow you to return a link to google search in your responses

### Install with composer
```php
composer require emurengine/lemurtag-googlesearch
```

### Create the AIML categories (optional)
Upload the file and link the file aiml/cstm-google-search.csv to your bot from inside the portal

### Example usage
```txt
  Example AIML:
  <category>
   <pattern>SEARCH GOOGLE FOR A *</pattern>
   <template><googlesearch><star /></googlesearch</template>
  </category>
 
  Expected Conversation:
  Input: Search google for a cake recipe
  Output: Check these search results: <a href="https://www.google.com/search?q=cake+recipe" target="_new">cake recipe</a>
 
  Documentation:
  https://docs.lemurengine.com/extend.html
```
