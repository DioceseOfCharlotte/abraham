function supportsFlexBox() {
    var test = document.createElement('test');

    test.style.display = 'flex';

    return test.style.display === 'flex';
}

if (supportsFlexBox()) {
    // Modern Flexbox is supported
} else {
    flexibility(document.documentElement);
}
