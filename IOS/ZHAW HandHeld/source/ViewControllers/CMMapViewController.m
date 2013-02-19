//
//  CMMapViewController.m
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 19.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "CMMapViewController.h"

@interface CMMapViewController ()

@end

@implementation CMMapViewController
@synthesize article, dbManager, locationItems, rootViewController, mapImage;


- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        [self setRootViewController:[[UIViewController alloc] init]];
    }
    return self;
}

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db
{
    [self setArticle:a];
    [self setDbManager:db];
    [self setLocationItems:[[NSMutableArray alloc] init]];
    
    NSDictionary* structuredData = [[self dbManager] parseArticleData:[[self article] data]];
    
    for (id fieldID in structuredData) {
        
        HHFieldModel* field = [structuredData objectForKey:fieldID];
        
        if ([field.fieldTypeName isEqualToString:@"text"]) {
            if ([field.name isEqualToString:@"Title"]) {
                self.title = field.data;
            }
            
        }
        else if ([field.fieldTypeName isEqualToString:@"resource_path"])
        {
            if ([field.name isEqualToString:@"Map Image"])
            {
                [self setMapImage:[field getImageForResource]];
            }
        }
        else if ([field.fieldTypeName isEqualToString:@"Location"])
        {
            CMLocationItemView* location = [[CMLocationItemView alloc] initWithFrame:CGRectMake(0, 0, 60, 60)];
            [location initializeWithField:field andHHManager:dbManager];
            [locationItems addObject:field];
            
        }
    }
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    [self setNavigationBarHidden:NO];
    [self.navigationBar setTintColor:[UIColor blackColor]];
    [self.view setBackgroundColor:[UIColor blackColor]];
    [self.rootViewController.view setFrame:CGRectMake(0, 0, self.view.frame.size.width , self.view.frame.size.height)];
    [self.rootViewController.view setBackgroundColor:[UIColor orangeColor]];
    [self.rootViewController setTitle:self.title];
    UIImageView* mapImageView = [[UIImageView alloc] initWithImage:self.mapImage];
    [mapImageView setFrame:CGRectMake(0, 0, self.view.frame.size.width, self.view.frame.size.height - 110)];
    [self.rootViewController.view addSubview:mapImageView];
    [self pushViewController:self.rootViewController animated:NO];
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
