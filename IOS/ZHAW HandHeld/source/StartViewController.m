//
//  StartViewController.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "StartViewController.h"
#import "AppDelegate.h"



@interface StartViewController ()


@end

@implementation StartViewController

@synthesize loggingWindow;
@synthesize loggingActivity;
@synthesize loggingMessage;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        
        [[NSNotificationCenter defaultCenter] addObserver:self selector:@selector(hhAction:) name:@"HHAction" object:nil];
        netStatusHandler = [[NetworkHandler alloc] initwithDelegate:self];
        [netStatusHandler setDelegate:self];
        assetDownloader = [[AssetDownloader alloc] init];
        [assetDownloader setDelegate:self];
        
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

-(void)viewDidAppear:(BOOL)animated
{
    [loggingMessage setText:@"test"];
    [self startApp];
    
}

-(void)startApp
{
    
    if (netStatusHandler.wifiActive && netStatusHandler.hostActive) {
        
        
        [assetDownloader downloadDBFile];
        handheldDBManager = [[SqLiteDatabaseManager alloc] initWithPath:[SqLiteDatabaseManager pathToDB] ];
        [assetDownloader downloadAssetListSynchronous:[handheldDBManager getListOfFilesFromDB]];
    }
    
    if ([SqLiteDatabaseManager SqLiteDBFileIsDownloaded] ) {
        
        handheldDBManager = [[SqLiteDatabaseManager alloc] initWithPath:[SqLiteDatabaseManager pathToDB] ];
        NSArray* documents = [handheldDBManager getAllDocuments];
        mainDocument = [[HHDocumentModel alloc] initWithDBManager:handheldDBManager andDocumentArray:[documents objectAtIndex:1]];
        
        
        
        UIViewController *startViewController = [[mainDocument startArticle] getViewControllerForTemplate];
        [startViewController.view setFrame:CGRectMake(5, 5, self.view.frame.size.width - 10, self.view.frame.size.height - 10)];
        [self.view addSubview:startViewController.view];
    }
    
}


-(void)setDownloaderStatus:(NSString *)status
{
    
}

-(void)setDBPath:(NSString *)dbpath
{
    handheldDBManager  = [[SqLiteDatabaseManager alloc] initWithPath:dbpath];
    
}

-(void)createLoggerMessage:(NSString *)message
{
    
     [self performSelectorOnMainThread:@selector(drawLogMessage:) withObject:message waitUntilDone:NO];
    
}

-(void)drawLogMessage:(NSString *)message
{
    [loggingMessage setText:message];
    [self.loggingMessage setNeedsDisplay];
}

- (void)hhAction:(NSNotification *)notification
{
    
    NSString* action = [[notification userInfo] objectForKey:@"action"];
    
    if ([action isEqualToString:@"go to article"]) {
        
        NSNumber *articleID = [[notification userInfo] objectForKey:@"article"];
        HHArticleModel *article = [handheldDBManager getArticleForArticleID:articleID];
        UIViewController *viewController = [self getViewControllerForArticle:article];
    
        if ([viewController isKindOfClass:[CMTabBarController class]]) {
            
            //[self.tabBarController setViewControllers:[(UITabBarController*)viewController viewControllers]];
            [viewController.view setFrame:CGRectMake(0, 0, self.view.frame.size.width, self.view.frame.size.height)];
            [self.view addSubview:viewController.view];
            
        }else{
            [viewController.view setFrame:CGRectMake(0, 0, self.view.frame.size.width, self.view.frame.size.height)];
            [self.view addSubview:viewController.view];
            
        }
    }else if ([action isEqualToString:@"push article"])
    {
        NSNumber *articleID = [[notification userInfo] objectForKey:@"article"];
        HHArticleModel *article = [handheldDBManager getArticleForArticleID:articleID];
        UIViewController *viewController = [self getViewControllerForArticle:article];
        
        //[self.activeNavController pushViewController:viewController animated:YES];
        
        UINavigationController* navCon = [notification object];
        [navCon pushViewController:viewController animated:YES];
        
    }
    
    
}

- (UIViewController *)getViewControllerForArticle:(HHArticleModel *)article
{
    
    UIViewController *articleView;
    
    switch ([article.template_id intValue]) {
        case 22:
            
            articleView = [[ComputerMusuemStartView alloc] init];
            [(ComputerMusuemStartView *)articleView initializeWithArticle:article];
            
            break;
            
        case 10: //Start Menu
            
            articleView = [[CMMainMenu alloc] initWithNibName:@"CMMainMenu" bundle:nil];
            [(CMMainMenu *)articleView initializeWithArticle:article andHHManager:handheldDBManager];
            activeNavController = (UINavigationController *)articleView;
            
            break;
        case 19:
            
            articleView = [[CMContentView alloc] init];
            [(CMContentView *)articleView initializeWithArticle:article andHHManager:handheldDBManager];
            
            break;
        case 20: //map view
            
            articleView = [[CMMapViewController alloc] init];
            [(CMMapViewController *)articleView initializeWithArticle:article andHHManager:handheldDBManager];
            
            break;
        case 24:
            
            articleView = [[CMTabBarController alloc] init];
            [(CMTabBarController *)articleView initializeWithArticle:article andHHManager:handheldDBManager];
            NSMutableArray *viewArray = [[NSMutableArray alloc] init];
            

            
            for (UITabBarItem* tabBarItem in [articleView tabBarItems])
            {
                
                HHArticleModel* tempArticle = [handheldDBManager getArticleForArticleID:tabBarItem.tag];
                UIViewController* tempView = [self getViewControllerForArticle:tempArticle];
                [tempView setTabBarItem:tabBarItem];
                [viewArray addObject:tempView];
                
            }
            
            [(UITabBarController *)articleView setViewControllers:viewArray];
            
            [viewArray autorelease];
            break;
        case 25: //info page
            
            articleView = [[CMContentView alloc] init];
            [(CMContentView *)articleView initializeWithArticle:article andHHManager:handheldDBManager];
            
            break;
            
        default:
            articleView = [[ComputerMusuemStartView alloc] init];
            [(ComputerMusuemStartView *)articleView initializeWithArticle:article];
            break;
    }
    
    return (UIViewController *)articleView ;
    
}

@end
