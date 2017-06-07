import { MyProjectPage } from './app.po';

describe('my-project App', () => {
  let page: MyProjectPage;

  beforeEach(() => {
    page = new MyProjectPage();
  });

  it('should display welcome message', done => {
    page.navigateTo();
    page.getParagraphText()
      .then(msg => expect(msg).toEqual('Welcome to app!!'))
      .then(done, done.fail);
  });
});
