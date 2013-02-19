//
//  StartViewController.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 11.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "NetworkHandler.h"
#import "AssetDownloader.h"
#import "SqLiteDatabaseManager.h"
#import "HHArticleModel.h"
#import "HHDocumentModel.h"
#import "ComputerMusuemStartView.h"
#import "CMContentView.h"
#import "CMTabBarController.h"
#import "CMMainMenu.h"
#import "CMMapViewController.h"

@interface StartViewController : UIViewController <NSURLConnectionDelegate, UIAlertViewDelegate, AssetDownloaderDelegate, UITabBarControllerDelegate, AssetDownloaderDelegate>
{
    NSMutableData *_responseData;
    NSURLConnection *_connection;
    
    NetworkHandler* netStatusHandler;
    BOOL downloadRequired;
    
    IBOutlet UIView  *loggingWindow;
    IBOutlet UILabel  *loggingMessage;
    UIActivityIndicatorView IBOutlet *loggingActivity;
    
    AssetDownloader* assetDownloader;
    SqLiteDatabaseManager* handheldDBManager;
    
    HHDocumentModel *mainDocument;
    HHArticleModel  *startArtice;
    
    UINavigationController* activeNavController;
    
}

@property (nonatomic, retain) IBOutlet UIView  *loggingWindow;
@property (nonatomic, retain) IBOutlet UILabel  *loggingMessage;
@property (nonatomic, retain) UIActivityIndicatorView IBOutlet *loggingActivity;
@property (nonatomic, retain) UINavigationController* activeNavController;


-(void)setDownloaderStatus:(NSString *)status;
-(void)setDBPath:(NSString *)dbpath;
-(void)createLoggerMessage:(NSString *)message;
- (void)hhAction:(NSNotification *)notification;
- (UIViewController *)getViewControllerForArticle:(HHArticleModel *)article;

-(void)startApp;

@end
